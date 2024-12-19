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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/proyek-investasi/jurnal/') }}">Jurnal Proyek</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Proyek</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $proyek->nama_proyek }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kabupaten</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $proyek->kabupaten }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $proyek->kecamatan }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Desa</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $proyek->desa }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Dana Terkumpul</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($proyek->dana_terkumpul) }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Target Investasi</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($proyek->target_invest) }}" readonly>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <h5 class="card-title">Detail Jurnal Proyek</h5>
                        <table class="table table-striped" id="tb_jurnal">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Saldo Awal</th>
                                    <th>Kredit</th>
                                    <th>Debit</th>
                                    <th>Saldo Akhir</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jurnals as $jurnal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{\Carbon\Carbon::parse($jurnal->tanggal)->format('d-m-Y')}}</td>
                                        <td>{{ formatRupiah($jurnal->saldo_awal) }}</td>
                                        <td>{{ formatRupiah($jurnal->kredit) }}</td>
                                        <td>{{ formatRupiah($jurnal->debit) }}</td>
                                        <td>{{ formatRupiah($jurnal->saldo_akhir) }}</td>
                                        <td>{{ $jurnal->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-end mt-4 mb-4">
                    <button type="button" class="btn btn-secondary" style="margin-right: 1.5rem" onclick="buttonBack()">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function buttonBack() {
        location.replace("{{ url('administrator/proyek-investasi/jurnal/') }}");
    }
</script>
@endsection
