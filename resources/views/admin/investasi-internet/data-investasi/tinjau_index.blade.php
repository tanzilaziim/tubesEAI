@extends('admin.master')
@section('title', 'Tinjau Investasi')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tinjau Investasi</h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Calon Investor</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->nama_lengkap }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ \Carbon\Carbon::parse($user->tanggal)->format('d-m-Y') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No HP</label>
                        <div class="col-lg-8">
                            <a href="https://wa.me/{{ $user->no_hp }}" class="form-control" readonly>{{ $user->no_hp }}</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->nik }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NPWP</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->npwp }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Proyek</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $investasi->proyek->nama_proyek }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total Investasi</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($investasi->total_investasi) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Investasi</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $investasi->tanggal }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bukti Transfer</label>
                        <div class="col-lg-8">                     
                            <a href="{{ asset('storage/' . $investasi->bukti_transfer) }}">
                                <img src="{{ asset('storage/' . $investasi->bukti_transfer) }}" class="img-fluid" alt="Bukti Transfer">
                            </a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <form action="{{ url('administrator/investasi-internet/data-investasi/setujui', $investasi->id_investasi) }}" method="POST" class="mr-2">
                                @csrf
                                <button type="submit" class="btn btn-primary">Setujui</button>
                            </form>
                            <form action="{{ url('administrator/investasi-internet/data-investasi/tolak', $investasi->id_investasi) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </div>
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
        location.replace("{{ url('administrator/investasi-internet/data-investasi') }}");
    }
</script>
@endsection
