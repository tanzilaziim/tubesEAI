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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/pengguna/internal/') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">
                        Isi data admin baru yang ingin anda tambahkan
                    </p>

                    @if (Session::has('error'))
                        <div class="row grid-margin">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <span>{{ Session::get('error') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="row grid-margin">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    <span>{{ Session::get('success') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/administrator/pengguna/internal/data-save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="username" id="username" type="text" placeholder="Username" value="{{ old('username') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="email" id="email" type="email" placeholder="email@mail.com" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="jabatan" id="jabatan" type="text" placeholder="Jabatan" value="{{ old('jabatan') }}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="password_value" id="password_value" type="password" placeholder="*******" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="password_value_confirmation" id="password_value_confirmation" type="password" placeholder="*******" required>
                            </div>
                        </div>

                        <div class="template-demo d-flex justify-content-between flex-wrap">
                            <input type="hidden" name="status_save" value="Insert" />
                            <input type="hidden" name="role_id" value="1" />
                            <button type="submit" class="btn btn-primary">Tambahkan data</button>
                            <button type="button" class="btn btn-secondary" onclick="buttonBack()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {

    });

    function buttonBack() {
        location.replace("{{ url('administrator/pengguna/internal/') }}");
    }
</script>
@endsection
