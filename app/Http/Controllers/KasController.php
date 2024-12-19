<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalInvestasiModel;
use Carbon\Carbon;

class KasController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Laporan Arus Kas'; 

        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));

        $tanggalAwal = $bulan . '-01';
        $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal)); 

        $bulanSebelumnya = Carbon::parse($tanggalAwal)->subMonth();
        $tanggalAwalBulanSebelumnya = $bulanSebelumnya->startOfMonth()->toDateString();
        $tanggalAkhirBulanSebelumnya = $bulanSebelumnya->endOfMonth()->toDateString();

        $saldoAwal = JurnalInvestasiModel::whereBetween('created_at', [$tanggalAwalBulanSebelumnya, $tanggalAkhirBulanSebelumnya])
                        ->orderBy('created_at', 'desc')
                        ->value('saldo_akhir') ?? 0;

        $saldoAkhir = JurnalInvestasiModel::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
                        ->orderBy('created_at', 'desc')
                        ->value('saldo_akhir') ?? 0;

        $totalPenerimaan = JurnalInvestasiModel::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->sum('kredit');
        $totalPengeluaran = JurnalInvestasiModel::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->sum('debit');

        $kenaikanPenurunanKas = $saldoAkhir - $saldoAwal;

        return view('admin.laporan.kas.index', compact(
            'title', 'saldoAwal', 'saldoAkhir', 'totalPenerimaan', 'totalPengeluaran', 'kenaikanPenurunanKas', 'bulan'
        ));
    }
}
