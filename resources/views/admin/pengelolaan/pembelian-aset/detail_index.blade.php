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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/pengelolaan/pembelian-aset') }}">Pembelian Aset</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Aset</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pembelianAset->nama_aset }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pembelianAset->jumlah }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Masa Manfaat (bulan)</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pembelianAset->masa_manfaat }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Pembelian</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Carbon\Carbon::parse($pembelianAset->tanggal)->format('d-m-Y') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Biaya Satuan</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($pembelianAset->biaya_satuan) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total Biaya</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($pembelianAset->total_biaya) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                        <div class="col-lg-8">
                            <a href="{{ asset('storage/' . $pembelianAset->bukti_pembayaran) }}" target="_blank">
                                <img src="{{ asset('storage/' . $pembelianAset->bukti_pembayaran) }}" class="img-fluid" alt="Bukti Pembayaran">
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" onclick="buttonBack()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function buttonBack() {
        location.replace("{{ url('administrator/pengelolaan/pembelian-aset') }}");
    }
</script>
@endsection