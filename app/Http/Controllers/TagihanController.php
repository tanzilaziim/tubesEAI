<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagihanModel;
use App\Models\PelangganModel;
use Carbon\Carbon;

class TagihanController extends Controller
{
    public function generateTagihan()
    {
        $currentDate = Carbon::now();

        if ($currentDate->day >= 20) {
            $pelanggan = PelangganModel::all();

            foreach ($pelanggan as $pelanggan) {
                $tanggalBerlangganan = Carbon::parse($pelanggan->tanggal_pemasangan);
                $biayaBerlangganan = $pelanggan->biaya_berlangganan;

                $daysSubscribed = $tanggalBerlangganan->diffInDays($currentDate);

                if ($daysSubscribed >= 30) {
                    $tagihanAmount = $biayaBerlangganan;
                } else {
                    $tagihanAmount = ($biayaBerlangganan / 30) * $daysSubscribed;
                }

                TagihanModel::create([
                    'id_pelanggan' => $pelanggan->id_pelanggan,
                    'tanggal' => $currentDate->toDateString(),
                    'tagihan' => $tagihanAmount,
                ]);
            }

            return response()->json(['message' => 'Tagihan untuk bulan berikutnya telah tergenerate.']);
        }

        return response()->json(['message' => 'Tagihan hanya dapat digenerate pada tanggal 9 setiap bulan.'], 400);
    }

    public function index(Request $request) 
    {
        $title = 'Tagihan Pengguna Internet';

        $bulan = $request->query('bulan', Carbon::now()->format('Y-m'));
    
        $currentDate = Carbon::now();
        if ($currentDate->day >= 20 && !TagihanModel::whereDate('tanggal', $currentDate->toDateString())->exists()) {
            $this->generateTagihan();
        }
    
        $query = TagihanModel::join('pelanggan_models', 'tagihan_models.id_pelanggan', '=', 'pelanggan_models.id_pelanggan')
                    ->select('tagihan_models.id_tagihan', 'pelanggan_models.id_pelanggan', 'pelanggan_models.nik', 'tagihan_models.tanggal', 'tagihan_models.tagihan', 'tagihan_models.metode_pembayaran', 'tagihan_models.bukti_pembayaran', 'tagihan_models.is_verified');
    
        if ($bulan) {
            $query->whereMonth('tagihan_models.tanggal', Carbon::parse($bulan)->month)
                  ->whereYear('tagihan_models.tanggal', Carbon::parse($bulan)->year);
        }
    
        $tagihan = $query->get();
    
        return view('admin.pengelolaan.tagihan.index', compact('title', 'tagihan', 'bulan'));
    }     

    public function verifikasi(Request $request, $id)
    {
        try {
            $tagihan = TagihanModel::where('id_tagihan', $id)->firstOrFail(); 
            
            if ($tagihan->is_verified == 1) {
                return response()->json(['message' => 'Tagihan sudah terverifikasi.'], 400);
            }

            $tagihan->is_verified = 1;
            $tagihan->save();

            return response()->json(['message' => 'Tagihan berhasil diverifikasi.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan.'], 500);
        }
    }

    public function edit($id)
    {
        $tagihan = TagihanModel::with('pelanggan')->where('id_tagihan', $id)->firstOrFail();
        $title = 'Edit Tagihan';

        return view('admin.pengelolaan.tagihan.edit_index', compact('title', 'tagihan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tagihan = TagihanModel::where('id_tagihan', $id)->firstOrFail();

        if ($request->hasFile('bukti_pembayaran')) {
            $fileName = time() . '_' . $request->file('bukti_pembayaran')->getClientOriginalName();
            $filePath = $request->file('bukti_pembayaran')->storeAs('uploads/bukti_pembayaran', $fileName, 'public');
            $tagihan->bukti_pembayaran = $filePath;
        }        

        $tagihan->metode_pembayaran = $request->metode_pembayaran;
        $tagihan->is_verified = 1;
        $tagihan->save();

        return redirect('administrator/pengelolaan/tagihan')->with('success', 'Tagihan berhasil diperbarui dan diverifikasi.');
    }
}
