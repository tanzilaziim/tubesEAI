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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/pengajuan-investor/') }}">Pengajuan Investor</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->username }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-lg-8">
                            <a href="mailto:{{ $user->email }}" class="form-control" readonly>{{ $user->email }}</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->nama_lengkap }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->tempat_lahir }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{\Carbon\Carbon::parse($uset->tgl_lahir)->format('d-m-Y')}}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->nik }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto KTP</label>
                        <div class="col-lg-8">
                            <a href="{{ asset('storage/' . $user->foto_ktp) }}">
                                <img src="{{ asset('storage/' . $user->foto_ktp) }}" class="img-fluid" alt="Foto KTP">
                            </a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NPWP</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->npwp }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto NPWP</label>
                        <div class="col-lg-8">
                            <a href="{{ asset('storage/' . $user->foto_npwp) }}">
                                <img src="{{ asset('storage/' . $user->foto_npwp) }}" class="img-fluid" alt="Foto NPWP">
                            </a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->alamat }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No HP</label>
                        <div class="col-lg-8">
                            <a href="https://wa.me/{{ $user->no_hp }}" class="form-control" readonly>{{ $user->no_hp }}</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Verifikasi</label>
                        <div class="col-lg-8">
                            @if($user->is_verified != 0)
                                <span class="badge badge-success">Terverifikasi</span>
                            @else
                                <span class="badge badge-secondary">Perlu Verifikasi</span>
                            @endif
                        </div>
                    </div>

                    <div class="template-demo d-flex justify-content-between flex-wrap">
                        <form action="{{ url('administrator/investasi-internet/pengajuan-investor/verifikasi/update/'.$user->id_user) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Verifikasi</button>
                        </form>
                        <button type="button" class="btn btn-secondary" onclick="buttonBack()">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function buttonBack() {
        location.replace("{{ url('administrator/investasi-internet/pengajuan-investor') }}");
    }
</script>
@endsection
