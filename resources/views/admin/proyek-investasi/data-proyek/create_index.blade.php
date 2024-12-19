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
                    <p class="card-description">Isi data proyek baru yang ingin anda tambahkan</p>

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

                    <form method="POST" action="{{ url('/administrator/proyek-investasi/data-proyek/data-save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Proyek</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nama_proyek" id="nama_proyek" type="text" placeholder="Nama Proyek" value="{{ old('nama_proyek') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">URL Map</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="url_map" id="url_map" type="text" placeholder="frame google maps" value="{{ old('url_map') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto Banner</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="foto_banner" id="foto_banner" type="file" accept=".jpg,.jpeg,.png,.heic" required>
                                <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .heic</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10" required>{{ old('deskripsi', $project->deskripsi ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">SWOT</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="swot" name="swot" rows="10" required>{{ old('swot', $project->swot ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Simulasi Keuntungan</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="simulasi_keuntungan" name="simulasi_keuntungan" rows="10" required>{{ old('simulasi_keuntungan', $project->simulasi_keuntungan ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Minimum Investasi</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="min_invest" id="min_invest" type="number" step="0.01" placeholder="Minimum Investasi" value="{{ old('min_invest') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Target Investasi</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="target_invest" id="target_invest" type="number" step="0.01" placeholder="Target Investasi" value="{{ old('target_invest') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="desa" id="desa" type="text" placeholder="Desa" value="{{ old('desa') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="kecamatan" id="kecamatan" type="text" placeholder="Kecamatan" value="{{ old('kecamatan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kabupaten</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="kabupaten" id="kabupaten" required>
                                    <option value="">Pilih Kabupaten</option>
                                    <option value="Cilacap" {{ old('kabupaten') == 'Cilacap' ? 'selected' : '' }}>Cilacap</option>
                                    <option value="Banjarnegara" {{ old('kabupaten') == 'Banjarnegara' ? 'selected' : '' }}>Banjarnegara</option>
                                    <option value="Banyumas" {{ old('kabupaten') == 'Banyumas' ? 'selected' : '' }}>Banyumas</option>
                                    <option value="Purbalingga" {{ old('kabupaten') == 'Purbalingga' ? 'selected' : '' }}>Purbalingga</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ROI</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="roi" id="roi" type="number" step="0.01" placeholder="ROI" value="{{ old('roi') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">BEP</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="bep" id="bep" type="number" step="0.01" placeholder="BEP" value="{{ old('bep') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grade</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="grade" id="grade" required>
                                    <option value="">Pilih Grade</option>
                                    <option value="A" {{ old('grade') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('grade') == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ old('grade') == 'C' ? 'selected' : '' }}>C</option>
                                    <option value="D" {{ old('grade') == 'D' ? 'selected' : '' }}>D</option>
                                    <option value="E" {{ old('grade') == 'E' ? 'selected' : '' }}>E</option>
                                </select>
                            </div>
                        </div>

                        <div class="template-demo d-flex justify-content-between flex-wrap">
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
    function buttonBack() {
        location.replace("{{ url('administrator/proyek-investasi/data-proyek/') }}");
    }
    CKEDITOR.replace('deskripsi');

    CKEDITOR.replace('swot');

    CKEDITOR.replace('simulasi_keuntungan');

</script>

@endsection
