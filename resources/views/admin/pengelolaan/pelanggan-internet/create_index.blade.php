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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/pengelolaan/pelanggan') }}">Pelanggan</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">Isi data pelanggan baru yang ingin anda tambahkan</p>

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <span>{{ Session::get('error') }}</span>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <span>{{ Session::get('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/administrator/pengelolaan/pelanggan/data-save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Paket</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="id_paket" id="id_paket" required>
                                    <option value="">Pilih Paket</option>
                                    @foreach($jenis_paket as $jp)
                                        <option value="{{ $jp->id_paket }}">{{ $jp->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Pemasangan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="tanggal_pemasangan" id="tanggal_pemasangan" type="date" value="{{ old('tanggal_pemasangan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Biaya Berlangganan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="biaya_berlangganan" id="biaya_berlangganan" type="number" step="0.01" placeholder="Biaya Berlangganan" value="{{ old('biaya_berlangganan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Biaya Pemasangan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="biaya_pemasangan" id="biaya_pemasangan" type="number" step="0.01" placeholder="Biaya Pemasangan" value="{{ old('biaya_pemasangan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nik" id="nik" type="text" maxlength="16" placeholder="NIK" value="{{ old('nik') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto KTP</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="foto_ktp" id="foto_ktp" type="file" accept=".jpg,.jpeg,.png,.heic" required>
                                <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                            </div>
                        </div>
                        <div class="template-demo d-flex justify-content-between flex-wrap">
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                            <a href="{{ url('administrator/pengelolaan/pelanggan') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
