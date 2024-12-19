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
                            <li class="breadcrumb-item"><a href="{{ url('administrator/pengelolaan/tagihan') }}">Daftar Tagihan</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Edit Tagihan</span></li>
                        </ol>
                    </nav>
                    <br>
                    <div class="card-body">
                        <h4 class="card-title">Edit Tagihan</h4>
                        <form method="POST" action="{{ url('administrator/pengelolaan/tagihan/update', $tagihan->id_tagihan) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nik">NIK</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $tagihan->pelanggan->nik }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tagihan">Nominal Tagihan</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="tagihan" name="tagihan" value="{{ $tagihan->tagihan }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="metode_pembayaran">Metode Pembayaran</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="metode_pembayaran" id="metode_pembayaran" required>
                                        <option value="" disabled selected>Pilih metode pembayaran</option>
                                        <option value="Manual" {{ old('metode_pembayaran') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                                <div class="col-lg-8">
                                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                                </div>
                            </div>

                            <div class="template-demo d-flex justify-content-between flex-wrap">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ url('administrator/pengelolaan/tagihan') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection