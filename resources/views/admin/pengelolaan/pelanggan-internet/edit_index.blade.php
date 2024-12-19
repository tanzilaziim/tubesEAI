@extends('admin.master')
@section('title', $title)

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                        </ol>
                    </nav>
                    <br>
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <p class="card-description">Edit data pelanggan yang diinginkan</p>

                        <form method="POST" action="{{ url('/administrator/pengelolaan/pelanggan/data-update/' . $pelanggan->id_pelanggan_base) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="id_paket">Paket</label>
                                <div class="col-lg-8">
                                    <select class="form-control" id="id_paket" name="id_paket" required>
                                        @foreach($jenis_paket as $paket)
                                            <option value="{{ $paket->id_paket }}" {{ $pelanggan->id_paket == $paket->id_paket ? 'selected' : '' }}>{{ $paket->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tanggal_pemasangan">Tanggal Pemasangan</label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control" id="tanggal_pemasangan" name="tanggal_pemasangan" value="{{ old('tanggal_pemasangan', $pelanggan->tanggal_pemasangan) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="biaya_berlangganan">Biaya Berlangganan</label>
                                <div class="col-lg-8">
                                    <input type="number" class="form-control" id="biaya_berlangganan" name="biaya_berlangganan" value="{{ old('biaya_berlangganan', $pelanggan->biaya_berlangganan) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="biaya_pemasangan">Biaya Pemasangan</label>
                                <div class="col-lg-8">
                                    <input type="number" class="form-control" id="biaya_pemasangan" name="biaya_pemasangan" value="{{ old('biaya_pemasangan', $pelanggan->biaya_pemasangan) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nik">NIK</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $pelanggan->nik) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="foto_ktp">Foto KTP</label>
                                <div class="col-lg-8">
                                    @if($pelanggan->foto_ktp)
                                        <a href="{{ asset('storage/' . $pelanggan->foto_ktp) }}">
                                            <img src="{{ asset('storage/' . $pelanggan->foto_ktp) }}" class="img-fluid" alt="Foto KTP">
                                        </a>
                                    @endif
                                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept=".jpg,.jpeg,.png,.heic">
                                    <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                                </div>
                            </div>

                            <div class="template-demo d-flex justify-content-between flex-wrap">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ url('administrator/pengelolaan/pelanggan') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
