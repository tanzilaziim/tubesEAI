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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/pengajuan/') }}">Pengajuan</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Desa</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pengajuan->nama_desa }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kepala Desa</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pengajuan->kepala_desa }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pengajuan->kecamatan }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kabupaten</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pengajuan->kabupaten }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pengajuan->provinsi }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jumlah Penduduk</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $pengajuan->jumlah_penduduk }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor WA</label>
                        <div class="col-lg-8">
                            <a href="https://wa.me/{{ $pengajuan->nomor_wa }}" class="form-control" readonly>{{ $pengajuan->nomor_wa }}</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Catatan</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" rows="3" readonly>{{ $pengajuan->catatan }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" onclick="buttonBack()">Kembali</button>
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
        location.replace("{{ url('administrator/pengajuan-desa') }}");
    }
</script>
@endsection
