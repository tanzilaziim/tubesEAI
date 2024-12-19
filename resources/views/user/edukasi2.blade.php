@extends('layouts.user')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner bg-4">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Manajemen Resiko Investasi</h2>
            </div>
        </div>
    </div>
</div>
<br>
<!-- End Section Banner Area -->
<div class="nav-edukasi">
    <ul>
        <li><a href="{{ url('edukasi/dasar-investasi') }}" class="nav-link">Dasar Investasi</a></li>
        <li><a href="{{ url('edukasi/manajemen-resiko') }}" class="nav-link active">Manajemen Resiko Investasi</a></li>
        <li><a href="{{ url('edukasi/strategi-investasi') }}" class="nav-link">Strategi Investasi</a></li>
    </ul>
</div>
<br>
{{-- <p style="text-align: center">Sumber dari buku "Investment Risk Management" oleh Yen Yee Chong</p> --}}
<div class="edukasi-investasi ptb-100">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-7">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Apa itu Resiko Investasi?</h2>
                    <p>Dalam investasi, risiko adalah kemungkinan bahwa hasil yang diperoleh akan berbeda dari yang diharapkan, baik itu kerugian atau keuntungan. Risiko ini terbagi menjadi risiko sistemik, yang mempengaruhi seluruh pasar, dan risiko non-sistemik, yang hanya mempengaruhi sektor atau aset tertentu.</p>
                    <p>Lalu, Mengapa risiko itu penting? Memahami risiko penting dalam investasi karena membantu investor dalam membuat keputusan yang berinformasi dan mengelola potensi kerugian.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="image5" data-aos="fade-zoom-in" data-aos-delay="100">
                    <img src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="academics-area ptb-100">
    <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <h3 class="title-anime" style="font-size:36px">Jenis-Jenis Risiko Utama</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="academics-item" data-aos="fade-up" data-aos-delay="100">
                    <h4>Risiko Pasar</h4>
                    <p style="font-size: 18px">Terjadi akibat fluktuasi harga di pasar yang bisa dipengaruhi oleh berbagai faktor seperti perubahan ekonomi, politik, atau kejadian global.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="academics-item" data-aos="fade-up" data-aos-delay="200">
                    <h4>Risiko Likuiditas</h4>
                    <p style="font-size: 18px">Berkaitan dengan kemampuan untuk menjual aset tanpa mempengaruhi harga pasar secara signifikan.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="academics-item" data-aos="fade-up" data-aos-delay="300">
                    <h4>Risiko Kredit</h4>
                    <p style="font-size: 18px">Terkait dengan kemungkinan pihak lawan gagal memenuhi kewajiban finansialnya.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="academics-item" data-aos="fade-up" data-aos-delay="400">
                    <h4>Risiko Operasional</h4>
                    <p style="font-size: 18px">Menyangkut kegagalan proses internal, manusia, sistem, atau dari peristiwa eksternal yang dapat mengganggu kegiatan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-11">
    <div class="edukasi-overview">
        <h2>Identifikasi dan Penilaian Resiko</h2>
        <p>Penilaian risiko adalah proses krusial dalam manajemen risiko investasi yang melibatkan penggunaan metode analisis kuantitatif dan kualitatif untuk memahami dan mengukur risiko yang terkait dengan berbagai investasi.</p>
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Komponen</th>
                        <th>Deskripsi</th>
                        <th>Metode dan Contoh</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Analisis Kuantitatif</td>
                        <td>Menggunakan data numerik untuk mengukur risiko menggunakan model statistik.</td>
                        <td>Analisis varians, simulasi Monte Carlo, model CAPM.</td>
                    </tr>
                    <tr>
                        <td>Analisis Kualitatif</td>
                        <td>Penilaian subjektif terhadap risiko berdasarkan faktor non-numerik.</td>
                        <td>Evaluasi kualitas manajemen, stabilitas politik, perubahan regulasi.</td>
                    </tr>
                    <tr>
                        <td>Model Risiko</td>
                        <td>Alat untuk memproyeksikan perilaku aset atau portofolio di masa depan dalam berbagai kondisi pasar.</td>
                        <td>Model stres tes, kecerdasan buatan (AI).</td>
                    </tr>
                </tbody>
            </table>
        </div>    
        <p>Penilaian risiko adalah komponen kunci dalam manajemen investasi, menggabungkan analisis kuantitatif dan kualitatif untuk membantu investor mengidentifikasi dan mengelola potensi risiko. Penggunaan model risiko canggih memungkinkan prediksi yang lebih akurat dan strategi investasi yang lebih adaptif. Dengan pemahaman yang mendalam tentang risiko, investor dapat membuat keputusan yang lebih informasi dan mengurangi ketidakpastian dalam investasi mereka.</p>
        <br>
        <h2>Kebijakan dan prosedur manajemen risiko</h2>
    </div>
</div>
<div class="faculty-area-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <div class="text title-anim">
                        <h3>Pembentukan Kebijakan</h3>
                        <p>Kebijakan manajemen risiko menetapkan prinsip dan pedoman yang jelas bagi seluruh organisasi untuk mengikuti dalam mengidentifikasi, menilai, dan mengelola risiko. Tujuannya adalah untuk memastikan bahwa semua risiko dihadapi secara sistematis dan konsisten sesuai dengan toleransi risiko organisasi. Isi kebijakan mencakup definisi risiko, tujuan manajemen risiko, peran dan tanggung jawab, prosedur penilaian risiko, dan metode pengelolaan risiko.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6">
                <div class="content" data-aos="fade-up" data-aos-delay="200">
                    <div class="text title-anim">
                        <h3>Prosedur Pelaporan dan Pemantauan</h3>
                        <p>Proses Pemantauan Melibatkan pemantauan berkelanjutan atas risiko yang dihadapi organisasi dan efektivitas tindakan pengelolaan risiko yang diambil. Ini termasuk memantau indikator kinerja utama (KPI) dan indikator risiko utama (KRI) untuk mendeteksi perubahan dalam profil risiko. Pelaporan Risiko disiapkan secara berkala untuk memberikan pembaruan kepada manajemen senior dan dewan direksi. Laporan ini harus menyediakan analisis tentang status risiko, tindakan yang diambil, dan rekomendasi untuk perbaikan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="subscribe-area ptb-100">
    <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <div class="sub-title">
                <p>Ayo Mulai Investasi</p>
            </div>
            <h2>Jelajahi Proyek Investasi Internet</h2>
        </div>

        <div class="subscribe-btn-2 text-center" data-aos="fade-up" data-aos-delay="100">
            <a class="subscribe-btn" href="/proyek-investasi">Investasi Sekarang</a>
        </div>
    </div>
</div>  
@endsection