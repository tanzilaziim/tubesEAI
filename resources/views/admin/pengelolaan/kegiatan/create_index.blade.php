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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/kegiatan/') }}">Kegiatan</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">Isi data kegiatan baru yang ingin anda tambahkan</p>

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

                    <form method="POST" action="{{ url('/administrator/pengelolaan/kegiatan/data-save') }}" enctype="multipart/form-data">
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
                            <label class="col-sm-3 col-form-label">Nama Kegiatan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama_kegiatan" id="nama_kegiatan" type="text" placeholder="Nama Kegiatan" value="{{ old('nama_kegiatan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kegiatan</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="jenis_kegiatan" id="jenis_kegiatan" required>
                                    <option value="">Pilih jenis</option>
                                    <option value="Intalasi" {{ old('jenis_kegiatan') == 'Intalasi' ? 'selected' : '' }}>Instalasi</option>
                                    <option value="Perbaikan" {{ old('jenis_kegiatan') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                    <option value="Penyambungan Kabel" {{ old('jenis_kegiatan') == 'Penyambungan Kabel' ? 'selected' : '' }}>Penyambungan Kabel</option>
                                    <option value="Penanaman Tiang" {{ old('jenis_kegiatan') == 'Penanaman Tiang' ? 'selected' : '' }}>Penanaman Tiang</option>
                                    <option value="Penagihan Bandwith" {{ old('jenis_kegiatan') == 'Penagihan Bandwith' ? 'selected' : '' }}>Penagihan Bandwith</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Total Biaya</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="total_biaya" id="total_biaya" type="number" step="1000" placeholder="Total Biaya" value="{{ old('total_biaya') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Kegiatan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="tgl_kegiatan" id="tgl_kegiatan" type="date" value="{{ old('tgl_kegiatan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto Nota</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="foto_nota" id="foto_nota" type="file" accept=".jpg,.jpeg,.png,.pdf,.heic" required>         
                                <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic, .pdf</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto Kegiatan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="foto_kegiatan" id="foto_kegiatan" type="file" accept=".jpg,.jpeg,.png,.heic" required>
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
