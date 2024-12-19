@extends('layouts.user')

@section('content')
    <!-- Start Clgun Banner 2 Area -->
    <div class="banner-area-2 big-bg-2">
        <div class="container">
            <div class="banner-content-2">
                <div class="content">
                    <span data-aos="fade-zoom-in" data-aos-delay="300">VestNet: Investasi Internet Desa</span>
                    <h1 data-aos="fade-up" data-aos-delay="200">Menuju Masa Depan Desa Digital</h1>
                    <p data-aos="fade-up" data-aos-delay="300">Bergabung bersama kami menjadi bagian dari transformasi digital desa dengan berinvestasi pada proyek-proyek inovatif yang membawa perubahan nyata.</p>
                    <div class="buttons-action" data-aos="fade-up" data-aos-delay="100">
                        <a class="default-btn" href="/download">Investasi Sekarang</a>
                        <a class="default-btn btn-style-2" href="#contact">Hubungi Kami</a>
                    </div>
                    <div class="scroll-down" data-aos="fade-down" data-aos-delay="100">
                       <a href="#about"><i class='bx bx-chevron-down'></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Clgun Banner 2 Area -->

    <!-- Start Tentang VestNet -->
    <div class="faculty-area-3 ptb-100" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Apa itu VestNet?</h2>
                    <p>VestNet adalah platform investasi inovatif yang fokus pada pengembangan proyek internet desa. Kami menyediakan kesempatan bagi para investor untuk mendukung dan membiayai proyek-proyek infrastruktur digital yang bertujuan meningkatkan konektivitas dan kualitas hidup di desa. Dengan VestNet, Anda dapat berkontribusi pada penyediaan internet desa yang memadai serta meraih keuntungan dari investasi.</p>
                    <a class="default-btn" href="/download">Investasi Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Tentang VestNet -->             

     <!-- Start Keunggulan VestNet -->
     <div class="academics-area ptb-100" >
        <div class="container">
            <div class="section-title" data-aos="fade-up" data-aos-delay="100">
                <h2 class="title-anim">Danai Proyek Internet Desa dengan Mudah di Vestnet</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="academics-item" data-aos="fade-up" data-aos-delay="100">
                        <img src="assets/img/icon/keuntungan.png" alt="icon">
                        <h4>Potensi Keuntungan Tinggi</h4>
                        <p>Dengan berinvestasi di proyek-proyek internet desa yang sedang dijalankan, Anda memiliki peluang untuk mendapatkan bagi hasil yang tinggi seiring dengan meningkatnya kebutuhan konektivitas digital di pedesaan</p>
                        <a href="/simulasi-keuntungan">Pelajari Selengkapnya <i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="academics-item" data-aos="fade-up" data-aos-delay="200">
                        <img src="assets/img/icon/sosial.png" alt="icon">
                        <h4>Dampak Sosial Positif</h4>
                        <p>Investasi Anda membantu membangun infrastruktur digital yang mendukung pendidikan, kesehatan, dan ekonomi di desa. Anda tidak hanya mendapatkan keuntungan finansial, tetapi juga berkontribusi dalam meningkatkan kualitas hidup masyarakat desa.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="academics-item" data-aos="fade-up" data-aos-delay="300">
                        <img src="assets/img/icon/keamanan.png" alt="icon">
                        <h4>Transparansi dan Keamanan</h4>
                        <p>VestNet memastikan transparansi dan keamanan dalam setiap proyek yang ditawarkan. Anda dapat memantau perkembangan proyek secara real-time dan mendapatkan laporan berkala, sehingga Anda merasa aman dan yakin dengan investasi yang Anda lakukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Keunggulan Vestnet -->

    <!-- Start Faculty Area 2 -->
    <div class="faculty-area-2 ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10">
                    <div class="heading" data-aos="fade-up" data-aos-delay="100">
                        <h2>Tunggu Apalagi?
                        <br>Ayo mulai investasi di VestNet sekarang!</h2>
                    </div>
                </div>
                <div class="col-lg-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="button">
                        <a class="default-btn" href="/download">Yuk Investasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Faculty Area 2 -->

    <!-- Start Proyek Internet Desa -->
    <div class="courses-area ptb-100">
        <div class="container">
            <div class="section-title" data-aos="fade-up" data-aos-delay="100">
                 <h2 class="title-anim">Mulai Investasi Sekarang</h2>
            </div>
            <div class="courses-courser owl-carousel owl-theme">
                @foreach($projects as $project)
                    @if($project->status != 'Pendanaan selesai')
                    <div class="course-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="image">
                            <img src="{{ asset('storage/' . $project->foto_banner) }}" alt="image">
                        </div>
                        <div class="content title-anim">
                            <span>Kec. {{ $project->kecamatan }}, Kab.{{ $project->kabupaten }}</span> 
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
                                @endif
                                @if($project->grade == 'B')
                                <div class="grade-b">
                                @endif
                                @if($project->grade == 'C')
                                <div class="grade-c">
                                @endif
                                @if($project->grade == 'D')
                                <div class="grade-d">
                                @endif
                                @if($project->grade == 'E')
                                <div class="grade-e">
                                @endif
                                    <h4">{{ $project->grade }}</h4> 
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Proyek Internet Desa -->  

    <!-- Start Form -->
    <div class="quick-search style-2 ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="course-search-box" data-aos="fade-right">
                        <h4>Form Pengajuan Internet Desa</h4>
                        <form action="{{ url('/home/pengajuan') }}" method="POST">
                            @csrf
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p>{{ $message }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p>{{ $message }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="form-input">
                                <label for="namadesa">Nama Desa</label>
                                <input class="form-control" placeholder="" type="text" id="namadesa" name="nama_desa" required title="Silahkan isi terlebih dahulu">
                                
                                <label for="kecamatan">Kecamatan</label>
                                <input class="form-control" placeholder="" type="text" id="kecamatan" name="kecamatan" required title="Silahkan isi terlebih dahulu">
                                
                                <label for="kabupaten">Kabupaten</label>
                                <select class="form-select" aria-label="Default select example" id="kabupaten" name="kabupaten" required title="Silahkan isi terlebih dahulu">
                                    <option selected>Pilih Kabupaten</option>
                                    <option value="Kab. Banyumas">Kab. Banyumas</option>
                                    <option value="Kab. Cilacap">Kab. Cilacap</option>
                                    <option value="Kab. Purbalingga">Kab. Purbalingga</option>
                                    <option value="Kab. Banjarnegara">Kab. Banjarnegara</option>
                                </select>
                                
                                <label for="provinsi">Provinsi</label>
                                <select class="form-select" aria-label="Default select example" id="provinsi" name="provinsi" required title="Silahkan isi terlebih dahulu">
                                    <option selected>Pilih Provinsi</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                </select>
                                
                                <label for="kades">Nama Kepala Desa</label>
                                <input class="form-control" placeholder="" type="text" id="kades" name="kepala_desa" required title="Silahkan isi terlebih dahulu">
                                
                                <label for="jumlah">Jumlah Penduduk</label>
                                <input class="form-control" placeholder="" type="number" id="jumlah" name="jumlah_penduduk" required title="Silahkan isi terlebih dahulu">
                                                                
                                <label for="whatsapp">Nomor Whatsapp</label>
                                <input class="form-control" placeholder="" type="text" id="whatsapp" name="nomor_wa" maxlength="15" required title="Isi nomor whatsapp dengan format 08 atau +62">

                                
                                <label for="pesan">Pesan</label>
                                <input class="form-control" placeholder="" type="catatan" id="catatan" name="catatan">

                                <p style="color: red">*Setiap pengajuan dikenakan biaya administrasi Rp.5.000
                                
                                <button class="default-btn" type="submit">Kirim Pengajuan</button>
                            </div>
                        </form>
                    </div>
                </div>                
                <div class="col-lg-6">
                    <div class="quick-content" data-aos="fade-up" data-aos-delay="200">
                        <div class="sub-title">
                            <p>Ayo Bergabung</p>
                        </div>
                        <h2>Dorong Desa Anda menjadi Bagian dari Transformasi Digital</h2>
                        <p>Percayakan akses internet rumah di desa anda dengan layanan kami. Dapatkan keuntungan-keuntungan berikut:</p>

                        <div class="list">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="list-items">
                                        <ul>
                                            <li><i class='bx bx-right-arrow-circle'></i> Hanya Rp. 166.500/bulan </li>
                                            <li><i class='bx bx-right-arrow-circle'></i> Internet cepat & stabil</li>
                                            <li><i class='bx bx-right-arrow-circle'></i> Layanan cepat tanggap</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="list-items">
                                        <ul>
                                            <li><i class='bx bx-right-arrow-circle'></i> Kerjasama resmi dengan Pemerintah Desa</li>
                                            <li><i class='bx bx-right-arrow-circle'></i> Internet gratis setiap bulan (*s&k berlaku)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Form -->
@endsection