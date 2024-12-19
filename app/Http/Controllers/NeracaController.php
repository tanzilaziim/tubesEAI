<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PembelianAsetModel;
use App\Models\KegiatanModel;
use App\Models\JurnalInvestasiModel;

class NeracaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Laporan Neraca Keuangan';

        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));

        $jumlahAset = PembelianAsetModel::whereMonth('created_at', Carbon::parse($bulan)->month)
            ->sum('total_biaya');
        
        $jumlahKewajiban = KegiatanModel::whereMonth('created_at', Carbon::parse($bulan)->month)
            ->sum('total_biaya');
        
        $modal = JurnalInvestasiModel::whereMonth('created_at', Carbon::parse($bulan)->month)
            ->sum('kredit');

        $saldoLaba = JurnalInvestasiModel::whereMonth('created_at', Carbon::parse($bulan)->month)
            ->orderBy('created_at', 'desc')
            ->value('saldo_akhir');
        
        $jumlahKewajibanModalSaldoLaba = $jumlahKewajiban + $modal + $saldoLaba;

        return view('admin.laporan.neraca.index', compact(
            'title', 'jumlahAset', 'jumlahKewajiban', 'modal', 'saldoLaba', 'jumlahKewajibanModalSaldoLaba', 'bulan'
        ));
    }
}
