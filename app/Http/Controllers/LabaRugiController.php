<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalInvestasiModel; 
use App\Models\KegiatanModel; 
use App\Models\TagihanModel; 
use Carbon\Carbon;

class LabaRugiController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Laporan Laba Rugi'; 

        $bulan = $request->input('bulan', date('Y-m'));

        $startDate = $bulan . '-01';
        $endDate = date("Y-m-t", strtotime($startDate)); 

        $bulanSebelumnya = Carbon::parse($startDate)->subMonth();
        $startDateBulanSebelumnya = $bulanSebelumnya->startOfMonth()->toDateString();
        $endDateBulanSebelumnya = $bulanSebelumnya->endOfMonth()->toDateString();

        $saldoAwal = JurnalInvestasiModel::whereBetween('created_at', [$startDateBulanSebelumnya, $endDateBulanSebelumnya])
                                ->orderBy('created_at', 'desc')
                                ->first();

        $saldoAkhirBulan = JurnalInvestasiModel::whereBetween('created_at', [$startDate, $endDate])
                                ->orderBy('created_at', 'desc')
                                ->first();

        $totalPenghasilan = TagihanModel::whereMonth('created_at', '=', date('m', strtotime($bulan)))
                                   ->whereYear('created_at', '=', date('Y', strtotime($bulan)))
                                   ->where('is_verified', 1)
                                   ->sum('tagihan');

        $totalPengeluaran = KegiatanModel::whereMonth('tgl_kegiatan', '=', date('m', strtotime($bulan)))
                                    ->whereYear('tgl_kegiatan', '=', date('Y', strtotime($bulan)))
                                    ->sum('total_biaya');

        return view('admin.laporan.laba-rugi.index', compact(
            'title', 
            'bulan', 
            'saldoAwal', 
            'saldoAkhirBulan', 
            'totalPenghasilan', 
            'totalPengeluaran'
        ));
    }
}