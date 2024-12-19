@extends('layouts.user')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner bg-4">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Dasar Investasi</h2>
            </div>
        </div>
    </div>
</div>
<br>
<!-- End Section Banner Area -->
<div class="nav-edukasi">
    <ul>
        <li><a href="{{ url('edukasi/dasar-investasi') }}" class="nav-link active">Dasar Investasi</a></li>
        <li><a href="{{ url('edukasi/manajemen-resiko') }}" class="nav-link">Manajemen Resiko Investasi</a></li>
        <li><a href="{{ url('edukasi/strategi-investasi') }}" class="nav-link">Strategi Investasi</a></li>
    </ul>
</div>
<br>
<div class="edukasi-investasi ptb-50">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-7">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Apa itu Investasi?</h2>
                    <p>Investasi adalah proses alokasi sumber daya, seperti uang, dengan harapan memperoleh keuntungan di masa depan. Di desa, investasi sering difokuskan pada pengembangan infrastruktur seperti internet, yang tidak hanya membawa pengembalian finansial tetapi juga meningkatkan akses ke informasi, pendidikan, dan layanan kesehatan. Ini menjadikan investasi sebagai alat penting untuk kemajuan sosial dan ekonomi, membuka kesempatan bagi masyarakat desa untuk mengintegrasikan dengan ekonomi global dan meningkatkan kualitas hidup secara keseluruhan.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="image" data-aos="fade-zoom-in" data-aos-delay="100">
                    <img src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="edukasi-investasi ptb-50">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-5 order-lg-1">
                <div class="image2" data-aos="fade-zoom-in" data-aos-delay="100">
                    <img src="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-7 order-lg-2">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Mengapa Investasi Penting untuk Masyarakat Desa?</h2>
                    <p>Investasi sangat vital untuk pertumbuhan dan pengembangan ekonomi di desa. Dengan memperbaiki infrastruktur seperti internet, desa-desa dapat lebih mudah mengakses pasar, informasi kesehatan, dan pendidikan. Ini bukan hanya meningkatkan ekonomi lokal melalui peningkatan bisnis dan pariwisata, tetapi juga meningkatkan kualitas hidup dengan menyediakan layanan yang lebih baik dan peluang baru.</p>
                </div>
            </div>
        </div>
    </div>
</div>  

<div class="edukasi-investasi ptb-50">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-7">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Investasi Internet Sebagai Peluang</h2>
                    <p>Investasi dalam infrastruktur internet di desa tidak hanya mengatasi kesenjangan digital tetapi juga berpotensi menghasilkan pengembalian investasi yang signifikan. Sebagai infrastruktur yang menghubungkan desa dengan pasar global, internet membuka peluang untuk ekspansi bisnis dan peningkatan pendapatan, membuatnya menjadi investasi yang berharga baik secara sosial maupun ekonomi.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="image3" data-aos="fade-zoom-in" data-aos-delay="100">
                    <img src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="edukasi-investasi ptb-50">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-5 order-lg-1">
                <div class="image4" data-aos="fade-zoom-in" data-aos-delay="100">
                    <img src="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-7 order-lg-2">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Bagaimana Cara Memulai Investasi?</h2>
                    <p>Memulai investasi di desa bisa dilakukan dengan menyelidiki dan memanfaatkan sumber daya lokal yang ada, seperti memulai koperasi simpan pinjam atau investasi dalam infrastruktur pertanian. Pemerintah daerah seringkali memiliki program atau insentif untuk investasi infrastruktur yang bisa dimanfaatkan, seperti subsidi atau pinjaman dengan bunga rendah untuk proyek-proyek yang berfokus pada peningkatan kualitas hidup.</p>
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