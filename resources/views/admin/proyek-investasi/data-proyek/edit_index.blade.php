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
                    <p class="card-description">Ubah data proyek sesuai kebutuhan</p>

                    <form method="POST" action="{{ url('/administrator/proyek-investasi/data-proyek/update', $project->id_proyek) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Proyek</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama_proyek" id="nama_proyek" type="text" placeholder="Nama Proyek" value="{{ old('nama_proyek', $project->nama_proyek) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">URL Map</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="url_map" id="url_map" type="text" placeholder="frame google maps" value="{{ old('url_map', $project->url_map) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto Banner</label>
                            <div class="col-lg-8">
                                <a href="{{ asset('storage/' . $project->foto_banner) }}">
                                    <img src="{{ asset('storage/' . $project->foto_banner) }}" class="img-fluid" alt="Proyek Foto">
                                </a>
                                <input class="form-control" name="foto_banner" id="foto_banner" type="file" accept=".jpg,.jpeg,.png,.heic">
                                <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dokumentasi Proyek</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="dokumentasi[]" id="dokumentasi" type="file" accept=".jpg,.jpeg,.png" multiple>
                            </div>
                        </div>                         --}}

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10">{{ old('deskripsi', $project->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SWOT</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="swot" name="swot" rows="10">{{ old('swot', $project->swot) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Simulasi Keuntungan</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="simulasi_keuntungan" name="simulasi_keuntungan" rows="10">{{ old('simulasi_keuntungan', $project->simulasi_keuntungan) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Minimum Investasi</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="min_invest" id="min_invest" type="number" step="0.01" placeholder="Minimum Investasi" value="{{ old('min_invest', $project->min_invest) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Target Investasi</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="target_invest" id="target_invest" type="number" step="0.01" placeholder="Target Investasi" value="{{ old('target_invest', $project->target_invest) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="desa" id="desa" type="text" placeholder="Desa" value="{{ old('desa', $project->desa) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="kecamatan" id="kecamatan" type="text" placeholder="Kecamatan" value="{{ old('kecamatan', $project->kecamatan) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kabupaten</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="kabupaten" id="kabupaten">
                                    <option value="">Pilih Kabupaten</option>
                                    <option value="Cilacap" {{ old('kabupaten', $project->kabupaten) == 'Cilacap' ? 'selected' : '' }}>Cilacap</option>
                                    <option value="Banjarnegara" {{ old('kabupaten', $project->kabupaten) == 'Banjarnegara' ? 'selected' : '' }}>Banjarnegara</option>
                                    <option value="Banyumas" {{ old('kabupaten', $project->kabupaten) == 'Banyumas' ? 'selected' : '' }}>Banyumas</option>
                                    <option value="Purbalingga" {{ old('kabupaten', $project->kabupaten) == 'Purbalingga' ? 'selected' : '' }}>Purbalingga</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ROI</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="roi" id="roi" type="number" step="0.01" placeholder="ROI" value="{{ old('roi', $project->roi) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">BEP</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="bep" id="bep" type="number" step="0.01" placeholder="BEP" value="{{ old('bep', $project->bep) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grade</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="grade" id="grade">
                                    <option value="">Pilih Grade</option>
                                    <option value="A" {{ old('grade', $project->grade) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('grade', $project->grade) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ old('grade', $project->grade) == 'C' ? 'selected' : '' }}>C</option>
                                    <option value="D" {{ old('grade', $project->grade) == 'D' ? 'selected' : '' }}>D</option>
                                    <option value="E" {{ old('grade', $project->grade) == 'E' ? 'selected' : '' }}>E</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="status" id="status">
                                    <option value="Segera hadir" {{ old('status', $project->status) == 'Segera hadir' ? 'selected' : '' }}>Segera hadir</option>
                                    <option value="Dalam pendanaan" {{ old('status', $project->status) == 'Dalam pendanaan' ? 'selected' : '' }}>Dalam pendanaan</option>
                                </select>
                            </div>
                        </div>

                        <div class="template-demo d-flex justify-content-between flex-wrap">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('administrator/proyek-investasi/data-proyek') }}" class="btn btn-secondary">Batal</a>
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
    CKEDITOR.replace('deskripsi');
</script>

<script>
    CKEDITOR.replace('swot');
</script>

<script>
    CKEDITOR.replace('simulasi_keuntungan');
</script>

@endsection