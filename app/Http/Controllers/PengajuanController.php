<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanModel;
use App\Models\DokuModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PengajuanController extends Controller
{
    public function index()
    {
        $title = 'Pengajuan Internet Desa';
        $pengajuan = PengajuanModel::all();
        return view('admin.pengajuan-desa.index', compact('title', 'pengajuan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kepala_desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'jumlah_penduduk' => 'required|integer',
            'nomor_wa' => 'required|string|max:15',
            'catatan' => 'nullable|string',
        ]);

        try {
            $trxCode = 'TRX-' . strtoupper(uniqid());
            $totalPrice = 5000;

            $pengajuan = PengajuanModel::create([
                'nama_desa' => $validatedData['nama_desa'],
                'kepala_desa' => $validatedData['kepala_desa'],
                'kecamatan' => $validatedData['kecamatan'],
                'kabupaten' => $validatedData['kabupaten'],
                'provinsi' => $validatedData['provinsi'],
                'jumlah_penduduk' => $validatedData['jumlah_penduduk'],
                'nomor_wa' => $validatedData['nomor_wa'],
                'catatan' => $validatedData['catatan'] ?? '',
                'trx_code' => $trxCode,
                'grand_total' => $totalPrice,
            ]);

            $order = [
                'total_price' => $totalPrice,
                'name' => $pengajuan->kepala_desa,
                'email' => 'example@email.com',
                'phone_number' => $pengajuan->nomor_wa,
                'address' => $pengajuan->nama_desa . ', ' . $pengajuan->kecamatan,
                'country' => 'ID',
            ];

            $orderDetail = [
                [
                    'name' => 'Pembayaran Pengajuan Desa',
                    'quantity' => 1,
                    'price' => $totalPrice,
                    'currency' => 'IDR',
                ]
            ];

            $dokuModel = new DokuModel();
            $response = $dokuModel->checkout((object)$order, $orderDetail, $trxCode);

            $expiredDate = Carbon::createFromFormat('YmdHis', $response['response']['payment']['expired_date'])->toDateTimeString();

            $pengajuan->update([
                'pay_code' => $response['response']['order']['invoice_number'],
                'payment_url' => $response['response']['payment']['url'],
                'expired_date' => $expiredDate,
            ]);

            if (isset($response['response']['payment']['url']) && $response['response']['payment']['url']) {
                return redirect()->away($response['response']['payment']['url']);
            } else {
                return redirect()->back()->with('error', 'Pembayaran gagal. Coba lagi.');
            }            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pengajuan gagal, silahkan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        try {
            // Ambil data dari request
            $data = $request->all();

            $trxCode = $data['trxCode'] ?? null;
            $payCode = $data['payCode'] ?? null;

            if (!$trxCode || !$payCode) {
                return redirect('/home')->with('error', 'Data tidak lengkap. Pastikan kode transaksi dan pembayaran tersedia.');
            }

            // Cari data pengajuan berdasarkan trxCode
            $pengajuan = PengajuanModel::where('trx_code', $trxCode)->first();

            if (!$pengajuan) {
                return redirect('/home')->with('error', 'Pengajuan tidak ditemukan.');
            }

            // Periksa status transaksi menggunakan Doku API
            $dataStatus = $this->dokuModel->checkStatus($trxCode, $payCode);

            // Validasi response dari Doku
            if (isset($dataStatus['error']['message'])) {
                $this->handleTransactionStatus($pengajuan, 'Pending', 'Transaksi belum selesai atau terdapat kesalahan.');
                return redirect('/home')->with('error', 'Kesalahan pada transaksi: ' . $dataStatus['error']['message']);
            }

            // Ambil status transaksi dari response Doku
            $transactionStatus = $dataStatus['transaction']['status'] ?? 'Pending';

            switch ($transactionStatus) {
                case 'EXPIRED':
                    $status = 'Expired';
                    break;

                case 'SUCCESS':
                    $status = 'Success';
                    break;

                default:
                    $status = 'Pending';
                    break;
            }

            // Update status pengajuan berdasarkan hasil
            $pengajuan->update(['status' => $status]);

            $message = match ($status) {
                'Success' => 'Pembayaran berhasil diproses.',
                'Expired' => 'Pembayaran sudah kedaluwarsa.',
                default => 'Pembayaran masih dalam status pending.',
            };

            return redirect('/home')->with($status == 'Success' ? 'success' : 'error', $message);
        } catch (\Exception $e) {
            return redirect('/home')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    

    public function show($id)
    {
        $title = 'Detail Pengajuan Internet Desa';
        $pengajuan = PengajuanModel::find($id);
        return view('admin.pengajuan-desa.detail_index', compact('title', 'pengajuan'));
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $result = PengajuanModel::find($id)->delete();

        if ($result) {
            Session::flash('success', 'Data berhasil dihapus');
        } else {
            Session::flash('error', 'Data gagal dihapus');
        }

        return redirect('administrator/pengajuan-desa');
    }
}