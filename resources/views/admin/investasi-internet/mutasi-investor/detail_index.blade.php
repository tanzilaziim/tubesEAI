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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/investasi-internet/mutasi-investor/') }}">Investor</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{$title}}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $user->nama_lengkap }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-lg-8">
                            <a href="mailto:{{ $user->email }}" class="form-control" readonly>{{ $user->email }}</a>
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
                            <input class="form-control" value="{{ \Carbon\Carbon::parse($user->tanggal)->format('d-m-Y') }}" readonly>
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
                        <label class="col-sm-3 col-form-label">Jumlah Proyek Investasi</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $proyek_investasi->count() }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Proyek yang Diinvestasi</label>
                        <div class="col-lg-8">
                            <ul class="list-group">
                                @foreach($proyek_investasi as $proyek)
                                    <li class="list-group-item">{{ $proyek->nama_proyek }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <h5 class="card-title">Detail Mutasi Investor</h5>
                        <table class="table table-striped" id="tb_mutasi">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>No</th>
                                    <th>Saldo Awal</th>
                                    <th>Kredit</th>
                                    <th>Debit</th>
                                    <th>Saldo Akhir</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mutasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ formatRupiah($item->saldo_awal) }}</td>
                                        <td>{{ formatRupiah($item->kredit) }}</td>
                                        <td>{{ formatRupiah($item->debit) }}</td>
                                        <td>{{ formatRupiah($item->saldo_akhir) }}</td>
                                        <td>{{ $item->keterangan }}</td>
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
        location.replace("{{ url('administrator/investasi-internet/mutasi-investor/') }}");
    }
</script>
@endsection

