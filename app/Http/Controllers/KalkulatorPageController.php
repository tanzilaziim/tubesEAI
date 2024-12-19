<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyekModel;

class KalkulatorPageController extends Controller
{
    public function index()
    {
        $title = 'kalkulator';
        $projects = ProyekModel::all();

        return view('user.kalkulator', compact('title', 'projects'));
    }

    public function kalkulator(Request $request)
    {
        $request->validate([
            'proyek' => 'required',
            'nominal' => 'required|numeric|min:0'
        ]);

        $proyek = ProyekModel::find($request->proyek);
        $nominal = $request->nominal;

        $roi_tahun = $proyek->roi;
        $roi_bulan = ($nominal * $roi_tahun) / 100 / 12;
        $bep = $nominal / ($nominal * $roi_tahun / 100);

        $projects = ProyekModel::all(); // Reload projects for re-rendering
        $title = 'kalkulator';

        return view('user.kalkulator', compact('title', 'projects', 'proyek', 'roi_bulan', 'bep', 'nominal'));
    }
}