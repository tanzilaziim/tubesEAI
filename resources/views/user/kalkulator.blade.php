@extends('layouts.user')

@section('content')
<!-- Start Section Banner Area -->
<div class="section-banner bg-5">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Kalkulator Investasi</h2>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Kalkulator Investasi Area -->
<div class="academics-section ptb-100">
    <div class="container">
        <h2>Kalkulator Investasi</h2>
        <form action="{{ url('kalkulator/hitung') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="proyek">Pilih Proyek:</label>
                <select name="proyek" id="proyek" class="form-control" required>
                    <option value="">Pilih proyek</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id_proyek }}" {{ old('proyek') == $project->id_proyek ? 'selected' : '' }}>
                            {{ $project->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nominal">Nominal Investasi (Rp):</label>
                <input type="number" name="nominal" id="nominal" class="form-control" value="{{ old('nominal') }}" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Hitung</button>
        </form>

        @if(isset($proyek))
            <hr>
            <h3>Hasil Kalkulasi</h3>
            <p>Nama proyek: {{ $proyek->nama_proyek }}</p>
            <p>Nominal investasi: {{ formatRupiah($nominal, 0) }}</p>
            <p>Bagi hasil: {{ formatRupiah($roi_bulan, 0) }} / bulan</p>
            <p>Estimasi balik modal: {{ round($bep, 2) }} tahun</p>
        @endif
    </div>
</div>
<!-- End Kalkulator Investasi Area -->
@endsection