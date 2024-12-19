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
                        <p class="card-description">Edit data kegiatan yang diinginkan</p>

                        <form method="POST" action="{{ url('/administrator/pengelolaan/kegiatan/data-update', $kegiatan->id_kegiatan) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="id_proyek">ID Proyek</label>
                                <div class="col-lg-8">
                                    <select class="form-control" id="id_proyek" name="id_proyek">
                                        @foreach($proyek as $p)
                                            <option value="{{ $p->id_proyek }}" {{ $kegiatan->id_proyek == $p->id_proyek ? 'selected' : '' }}>{{ $p->nama_proyek }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Kegiatan</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="jenis_kegiatan" id="jenis_kegiatan" required>
                                        <option value="">Pilih jenis</option>
                                        <option value="Intalasi" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Intalasi' ? 'selected' : '' }}>Instalasi</option>
                                        <option value="Perbaikan" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                        <option value="Penyambungan Kabel" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Penyambungan Kabel' ? 'selected' : '' }}>Penyambungan Kabel</option>
                                        <option value="Penanaman Tiang" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Penanaman Tiang' ? 'selected' : '' }}>Penanaman Tiang</option>
                                        <option value="Penagihan Bandwith" {{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Penagihan Bandwith' ? 'selected' : '' }}>Penagihan Bandwith</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="total">Total Biaya</label>
                                <div class="col-lg-8">
                                    <input type="number" class="form-control" id="total_biaya" name="total_biaya" value="{{ old('total_biaya', $kegiatan->total_biaya) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tgl_kegiatan">Tanggal Kegiatan</label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control" id="tgl_kegiatan" name="tgl_kegiatan" value="{{ old('tgl_kegiatan', $kegiatan->tgl_kegiatan) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="foto_nota">Foto Nota</label>
                                <div class="col-lg-8">
                                    @if($kegiatan->foto_nota)
                                    <a href="{{ asset('storage/' . $kegiatan->foto_nota) }}">
                                        <img src="{{ asset('storage/' . $kegiatan->foto_nota) }}" class="img-fluid" alt="Foto Nota">
                                    </a>
                                    @endif
                                    <input type="file" class="form-control" id="foto_nota" name="foto_nota" accept=".jpg,.jpeg,.png,.pdf,.heic">
                                    <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic, .pdf</p>      
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="foto_kegiatan">Foto Kegiatan</label>
                                <div class="col-lg-8">
                                    @if($kegiatan->foto_kegiatan)
                                        <a href="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}">
                                            <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" class="img-fluid" alt="Foto Kegiatan">
                                        </a>
                                    @endif
                                    <input type="file" class="form-control" id="foto_kegiatan" name="foto_kegiatan" accept=".jpg,.jpeg,.png,.heic">
                                    <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                                </div>
                            </div>

                            <div class="template-demo d-flex justify-content-between flex-wrap">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ url('administrator/pengelolaan/kegiatan') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
