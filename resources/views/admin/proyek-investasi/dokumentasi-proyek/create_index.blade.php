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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/proyek-investasi/dokumentasi') }}">Dokumentasi Proyek</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">Isi data dokumentasi yang ingin anda tambahkan</p>

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

                    <form method="POST" action="{{ url('administrator/proyek-investasi/dokumentasi/data-save') }}" enctype="multipart/form-data">
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
                            <label class="col-sm-3 col-form-label">File Dokumentasi</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="file_url[]" id="file_url" type="file" accept=".jpg,.jpeg,.png,.heic" multiple required>
                                <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                            </div>
                        </div>

                        <div class="template-demo d-flex justify-content-between flex-wrap">
                            <button type="submit" class="btn btn-primary">Tambah Dokumentasi</button>
                            <a href="{{ url('administrator/proyek-investasi/dokumentasi') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
