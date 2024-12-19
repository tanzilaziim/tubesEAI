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
                            <li class="breadcrumb-item"><a href="{{ url('administrator/pengelolaan/asset') }}">Daftar Aset</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                        </ol>
                    </nav>
                    <br>
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <p class="card-description">Update data aset</p>
                        <form method="POST" action="{{ url('/administrator/pengelolaan/asset/update', $aset->id_aset) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nama_aset">Nama Aset</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="nama_aset" name="nama_aset" value="{{ $aset->nama_aset }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tanggal_update">Tanggal Update</label>
                                <div class="col-lg-8">
                                    <input class="form-control" name="tanggal_update" id="tanggal_update" type="date" value="{{ old('tanggal_update') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4">{{ old('keterangan', $aset->keterangan) }}</textarea>
                                </div>
                            </div>

                            <div class="template-demo d-flex justify-content-between flex-wrap">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ url('administrator/pengelolaan/asset') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
