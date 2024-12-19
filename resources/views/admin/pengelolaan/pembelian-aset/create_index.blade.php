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
                    <p class="card-description">Isi data pembelian aset baru yang ingin Anda tambahkan</p>

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

                    <form method="POST" action="{{ url('/administrator/pengelolaan/pembelian-aset/data-save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Proyek</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="id_proyek" id="id_proyek" required>
                                    <option value="">Pilih Proyek</option>
                                    @foreach($proyek as $p)
                                        <option value="{{ $p->id_proyek }}">{{ $p->nama_proyek }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Aset</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama_aset" id="nama_aset" type="text" placeholder="Nama Aset" value="{{ old('nama_aset') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="jumlah" id="jumlah" type="number" placeholder="Jumlah" value="{{ old('jumlah') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Masa Manfaat (Bulan)</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="masa_manfaat" id="masa_manfaat" type="number" placeholder="Masa Manfaat" value="{{ old('masa_manfaat') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="tanggal" id="tanggal" type="date" value="{{ old('tanggal') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Biaya Satuan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="biaya_satuan" id="biaya_satuan" type="number" placeholder="Biaya Satuan" value="{{ old('biaya_satuan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" type="file" value="{{ old('bukti_pembayaran') }}" accept=".jpg,.jpeg,.png,.heic" required>
                                <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                            </div>
                        </div>

                        <div class="template-demo d-flex justify-content-between flex-wrap">
                            <button type="submit" class="btn btn-primary">Tambahkan kegiatan</button>
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
