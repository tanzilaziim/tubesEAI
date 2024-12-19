@extends('admin.master')
@section('title', $title)

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('administrator/dashboard/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    
                    <!-- Filter Periode Bulan -->
                    <form action="{{ url('administrator/laporan/kas') }}" method="GET">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="bulan">Pilih Bulan</label>
                                <input type="month" name="bulan" id="bulan" class="form-control" value="{{ $bulan }}">
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary">Terapkan</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <!-- Bagian Header -->
                        <div class="mb-4">
                            @if($kenaikanPenurunanKas > 0)
                            <div class="flex-container">
                                <span>Kenaikan/Penurunan Kas dan Setara Kas</span>
                                <span class="nominal">{{ formatRupiah($kenaikanPenurunanKas) }}</span>
                            </div>                           
                            @else
                            <div class="flex-container">
                                <span>Kenaikan/Penurunan Kas dan Setara Kas</span>
                                <span class="nominal">({{ formatRupiah($kenaikanPenurunanKas) }})</span>
                            </div>     
                            @endif

                            <div class="flex-container">
                                <span>Saldo Awal Setara Kas</span>
                                <span class="nominal">{{ formatRupiah($saldoAwal) }}</span>
                            </div>
                            <div class="flex-container">
                                <span>Saldo Akhir Setara Kas</span>
                                <span class="nominal">{{ formatRupiah($saldoAkhir) }}</span>
                            </div>
                        </div>

                        <!-- Bagian Penerimaan Kas dan Setara Kas -->
                        <div class="card">
                            <div class="card-header-2" role="button" data-toggle="collapse" href="#collapsePenerimaan" aria-expanded="true" aria-controls="collapsePenerimaan">
                                <div class="flex-container">
                                    <span>PENERIMAAN KAS DAN SETARA KAS</span>
                                    <span class="nominal">{{ formatRupiah($totalPenerimaan) }}</span>
                                </div>
                            </div>
                            <div id="collapsePenerimaan" class="collapse show">
                                <div class="card-body">
                                    <div class="flex-container">
                                        <span>Kegiatan Usaha</span>
                                        <span class="nominal">{{ formatRupiah($totalPenerimaan) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Pengeluaran Kas dan Setara Kas -->
                        <div class="card mt-2">
                            <div class="card-header-2" role="button" data-toggle="collapse" href="#collapsePengeluaran" aria-expanded="true" aria-controls="collapsePengeluaran">
                                <div class="flex-container">
                                    <span>PENGELUARAN KAS DAN SETARA KAS</span>
                                    <span class="nominal">{{ formatRupiah($totalPengeluaran) }}</span>
                                </div>
                            </div>
                            <div id="collapsePengeluaran" class="collapse show">
                                <div class="card-body">
                                    <div class="flex-container">
                                        <span>Kegiatan Usaha</span>
                                        <span class="nominal">{{ formatRupiah($totalPengeluaran) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
