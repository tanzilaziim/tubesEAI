@extends('admin.master')
@section('title', $title)

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Penarikan Saldo</h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Investor</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $penarikan->investasi->user->nama_lengkap }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Whatsapp</label>
                        <div class="col-lg-8">
                            <a href="https://wa.me/{{ $penarikan->investasi->user->no_hp }}" class="form-control" readonly>{{ $penarikan->investasi->user->no_hp }}</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Bank</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $penarikan->investasi->user->jenis_bank }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Rekening</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $penarikan->investasi->user->no_rekening }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nominal Penarikan</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($penarikan->jumlah) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Saldo Investor</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($penarikan->saldo_akhir) }}" readonly>
                        </div>
                    </div>
                    <form action="{{ url('administrator/investasi-internet/penarikan-saldo/setujui', $penarikan->id_penarikan_saldo) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bukti Transfer</label>
                            <div class="col-lg-8">
                                <input type="file" name="bukti_transfer" class="form-control" accept=".jpg,.jpeg,.png,.heic" required>
                                <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                    <button type="submit" class="btn btn-primary setujui-btn">Setujui</button>
                                </form>   
                                <form action="{{ url('administrator/investasi-internet/penarikan-saldo/tolak', $penarikan->id_penarikan_saldo) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger tolak-btn">Tolak</button>
                                </form>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="buttonBack()">Batal</button>
                        </div>
                        </div>
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
        location.replace("{{ url('administrator/investasi-internet/penarikan-saldo/') }}");
    }
</script>
@endsection
