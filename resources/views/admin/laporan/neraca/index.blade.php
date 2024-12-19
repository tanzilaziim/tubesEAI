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

                    <!-- Tambahkan Dropdown untuk Sorting Berdasarkan Bulan -->
                    <form action="{{ url('administrator/laporan/neraca') }}" method="GET">
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
                            <div class="flex-container">
                                <span>Jumlah Aset</span> 
                                <span class="nominal">{{ formatRupiah($jumlahAset) }}</span>
                            </div>
                            <div class="flex-container">
                                <span>Jumlah Kewajiban, Modal, dan Saldo Laba</span>
                                <span class="nominal">{{ formatRupiah($jumlahKewajibanModalSaldoLaba) }}</span>
                            </div>
                        </div>

                        <!-- Bagian Aset -->
                        <div class="card">
                            <div class="card-header-2" role="button" data-toggle="collapse" href="#collapsePenerimaan" aria-expanded="true" aria-controls="collapsePenerimaan">
                                <div class="flex-container">
                                    <span>Aset</span>
                                    <span class="nominal">{{ formatRupiah($jumlahAset) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Kewajiban -->
                        <div class="card mt-2">
                            <div class="card-header-2" role="button" data-toggle="collapse" href="#collapsePengeluaran" aria-expanded="true" aria-controls="collapsePengeluaran">
                                <div class="flex-container">
                                    <span>Kewajiban</span>
                                    <span class="nominal">{{ formatRupiah($jumlahKewajiban) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Modal & Saldo Laba -->
                        <div class="card mt-2">
                            <div class="card-header-2" role="button" data-toggle="collapse" href="#collapsePengeluaran" aria-expanded="true" aria-controls="collapsePengeluaran">
                                <div class="flex-container">
                                    <span>Modal & Saldo Laba</span>
                                    <span class="nominal">{{ formatRupiah($modal + $saldoLaba) }}</span>
                                </div>
                            </div>
                            <div id="collapsePengeluaran" class="collapse show">
                                <div class="card-body">
                                    <div class="flex-container">
                                        <span>Modal</span>
                                        <span class="nominal">{{ formatRupiah($modal) }}</span>
                                    </div>
                                    <div class="flex-container">
                                        <span>Saldo Laba</span>
                                        <span class="nominal">{{ formatRupiah($saldoLaba) }}</span>
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
