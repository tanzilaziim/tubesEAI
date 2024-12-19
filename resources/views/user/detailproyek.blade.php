@extends('layouts.user')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner bg-3">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Detail Proyek</h2>
                <p data-aos="fade-up" data-aos-delay="200">{{ $project->nama_proyek }}</p>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->

<!-- Start Courses Details Area -->
<div class="courses-details-section pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="courses-details">
                    <div class="header-title">
                        <span>Desa {{ $project->desa }}, Kec. {{ $project->kecamatan }}, Kab. {{ $project->kabupaten }}</span>
                        <h2>{{ $project->nama_proyek }}</h2>
                        <p>{{ $project->created_at->format('d F Y') }}</p>
                        <div class="enrolls-count">
                            <img src="{{ asset('assets/img/icon/reading-2.png') }}" class="ikon" alt="icon"> 
                            <p>{{ $investmentCount }} orang telah berinvestasi</p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="content-pra">
                            <div class="title">
                                <h3>Lokasi</h3>
                            </div>
                            <p>{{ $project->desa }}, Kecamatan {{ $project->kecamatan }}, Kabupaten {{ $project->kabupaten }}, Provinsi Jawa Tengah</p>
                            <div class="tag">
                                <span>Koordinat:</span>
                                <br>
                                {!! $project->url_map !!}
                            </div>
                        </div>
                        <div class="content-pra">
                            <div class="title">
                                <h3>Deskripsi Proyek</h3>
                            </div>
                            {!! $project->deskripsi !!}
                        </div>
                        <div class="content-pra">
                            <div class="title">
                                <h3>Analisis SWOT</h3>
                            </div>
                                {!! $project->swot !!}
                        </div>
                        <div class="content-pra">
                            <div class="title">
                                <h3>Simulasi Keuntungan</h3>
                            </div>
                                {!! $project->simulasi_keuntungan !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-widget-area">
                    <div class="course-item">
                        <div class="image">
                            <img src="{{ asset('storage/' . $project->foto_banner) }}" alt="image">
                        </div>
                        <div class="content title-anim">
                            <span>Kec. {{ $project->kecamatan }}, Kab. {{ $project->kabupaten }}</span>
                            <h2 class="title-anim"><a href="/proyek-investasi/detail/{{ $project->id_proyek }}">{{ $project->nama_proyek }}</a></h2>
                            <div class="investment-details">
                                <div class="detail-item">
                                    <p>Min Investasi</p>
                                    <h10>{{ formatRupiah($project->min_invest) }}</h10>
                                </div>
                                <div class="detail-item">
                                    <p>Terkumpul</p>
                                    <h10>{{ formatRupiah($project->dana_terkumpul) }}</h10>
                                </div>
                            </div>
                            <div class="text-progress2">Progress</div>
                            <div class="progress-bar">
                                @php
                                    $progress = ($project->dana_terkumpul / $project->target_invest) * 100;
                                @endphp
                                <div class="progress" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="text-progress">{{ round($progress) }}%</div>
                            <div class="funding-info">
                                <p>Dana yang dibutuhkan</p>
                                <h11>{{ formatRupiah($project->target_invest) }}</h11>
                            </div>
                            <div class="funding-info">
                                <p>Estimasi ROI Per Tahun</p>
                                <h11>{{ $project->roi }}%</h11>
                            </div>
                            <div class="grade-info">
                                <p>Grade</p>
                                @if($project->grade == 'A')
                                    <div class="grade-a">
                                @elseif($project->grade == 'B')
                                    <div class="grade-b">
                                @elseif($project->grade == 'C')
                                    <div class="grade-c">
                                @elseif($project->grade == 'D')
                                    <div class="grade-d">
                                @elseif($project->grade == 'E')
                                    <div class="grade-e">
                                @endif
                                    <h4>{{ $project->grade }}</h4>
                                </div>
                            </div>
                        </div>
                        <a class="invest-btn" href="/download">Investasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Courses Details Area -->
@endsection
