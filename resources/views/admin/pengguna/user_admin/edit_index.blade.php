@extends('admin.master')
@section('title')
    {{ @$title }}
@endsection

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
                            Ubah data admin yang ingin anda inginkan
                        </p>

                        <form method="POST" action="{{ url('/administrator/pengguna/internal/data-edit') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="status_save" value="Update" />
                            <input type="hidden" name="data_id" value="{{ @$admin->id_user }}" />
                        
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="username">Username</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', @$admin->username) }}" required>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="email">Email</label>
                                <div class="col-lg-8">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', @$admin->email) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jabatan">Jabatan</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', @$admin->jabatan) }}" required>
                                </div>    
                            </div> 

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="current_password">Verifikasi Password Sekarang</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Masukkan password sekarang" required>
                                </div>
                            </div>                            
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="new_password">Password Baru</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru">
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi password baru">
                                </div>
                            </div>
                        
                            <div class="template-demo d-flex justify-content-between flex-wrap">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ url('administrator/pengguna/internal') }}" class="btn btn-secondary">Batal</a>
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
            // Additional JavaScript can be added here if needed
        });

        function buttonBack() {
            location.replace("{{ url('administrator/pengguna/internal/') }}");
        }
    </script>

@endsection
