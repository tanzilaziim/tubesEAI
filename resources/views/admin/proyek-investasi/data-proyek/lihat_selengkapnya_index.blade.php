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
                        <li class="breadcrumb-item"><a href="{{ url('administrator/proyek-investasi/data-proyek/') }}">Proyek</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Proyek</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $project->nama_proyek }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">URL Map</label>
                        <div class="col-lg-8">
                            {!! $project->url_map !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto Banner</label>
                        <div class="col-lg-8">
                            <a href="{{ asset('storage/' . $project->foto_banner) }}">
                                <img src="{{ asset('storage/' . $project->foto_banner) }}" class="img-fluid" alt="Proyek Foto">
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Minimal Investasi</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($project->min_invest) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Dana Terkumpul</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($project->dana_terkumpul) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Target Investasi</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ formatRupiah($project->target_invest) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kabupaten</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="Kab. {{ $project->kabupaten }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="Kec. {{ $project->kecamatan }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Desa</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $project->desa }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">ROI</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $project->roi }}%" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">BEP</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $project->bep }} Tahun" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Grade</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $project->grade }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $project->status }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" onclick="buttonBack()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function buttonBack() {
        location.replace("{{ url('administrator/proyek-investasi/data-proyek/') }}");
    }
</script>
@endsection
