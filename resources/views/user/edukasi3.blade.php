@extends('layouts.user')

@section('content')

<!-- Start Section Banner Area -->
<div class="section-banner bg-4">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Strategi Investasi</h2>
            </div>
        </div>
    </div>
</div>
<br>
<!-- End Section Banner Area -->
<div class="nav-edukasi">
    <ul>
        <li><a href="{{ url('edukasi/dasar-investasi') }}" class="nav-link">Dasar Investasi</a></li>
        <li><a href="{{ url('edukasi/manajemen-resiko') }}" class="nav-link">Manajemen Resiko Investasi</a></li>
        <li><a href="{{ url('edukasi/strategi-investasi') }}" class="nav-link active">Strategi Investasi</a></li>
    </ul>
</div>
<br>
{{-- <div class="col-lg-8">
    <div class="ac-overview-edukasi">
        <div class="pera-dec">
            <h3>Meraih Keberhasilan Investasi Internet Pedesaan dengan VestNet</h3>
            <div class="faq-content">
                <div class="faq-item">
                    <div class="faq-question">Alokasi Aset</div>
                    <div class="icon-container"><i class='bx bx-chevron-down'></i></div>
                </div>
                <div class="faq-answer">
                    <p>Alokasi aset bisa melibatkan penyeimbangan antara investasi infrastruktur fisik (seperti tower dan kabel) dan aset digital (seperti layanan cloud dan platform). Investasi ini harus disesuaikan dengan kebutuhan spesifik area pedesaan yang ditargetkan dan potensi pertumbuhan ekonomi setempat.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Diversifikasi</div>
                    <div class="icon-container"><i class='bx bx-chevron-down'></i></div>
                </div>
                <div class="faq-answer">
                    <p>Diversifikasi termasuk menginvestasikan dana tidak hanya dalam infrastruktur fisik, tetapi juga dalam pengembangan kapasitas dan pelatihan penduduk lokal untuk menggunakan dan memelihara teknologi internet. Hal ini memastikan bahwa proyek dapat bertahan terhadap risiko teknologi yang cepat usang dan meningkatkan dampak sosioekonomi.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Buy and Hold</div>
                    <div class="icon-container"><i class='bx bx-chevron-down'></i></div>
                </div>
                <div class="faq-answer">
                    <p>Investasi jangka panjang sangat penting dalam proyek infrastruktur seperti internet di pedesaan karena membutuhkan waktu yang lama untuk membangun jaringan dan mencapai titik impas. Strategi ini mengurangi biaya transaksi dan menekankan pertumbuhan jangka panjang dari kenaikan nilai aset.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Penggunaan Derivatif untuk Hedging</div>
                    <div class="icon-container"><i class='bx bx-chevron-down'></i></div>
                </div>
                <div class="faq-answer">
                    <p>Pada proyek investasi internet di pedesaan, derivatif keuangan dapat digunakan untuk mengelola risiko terkait dengan perubahan biaya material atau peralatan yang diperlukan untuk pembangunan infrastruktur, sehingga mengamankan harga pembelian atau penjualan di masa depan terhadap volatilitas harga.</p>
                </div>
            </div>
        </div>
    </div>
</div>     --}}
<div class="edukasi-investasi ptb-50">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-7">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Alokasi Aset</h2>
                    <p>Alokasi aset bisa melibatkan penyeimbangan antara investasi infrastruktur fisik (seperti tower dan kabel) dan aset digital (seperti layanan cloud dan platform). Investasi ini harus disesuaikan dengan kebutuhan spesifik area pedesaan yang ditargetkan dan potensi pertumbuhan ekonomi setempat.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="image6" data-aos="fade-zoom-in" data-aos-delay="100">
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
                <div class="image7" data-aos="fade-zoom-in" data-aos-delay="100">
                    <img src="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-7 order-lg-2">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Diversifikasi</h2>
                    <p>Diversifikasi termasuk menginvestasikan dana tidak hanya dalam infrastruktur fisik, tetapi juga dalam pengembangan kapasitas dan pelatihan penduduk lokal untuk menggunakan dan memelihara teknologi internet. Hal ini memastikan bahwa proyek dapat bertahan terhadap risiko teknologi yang cepat usang dan meningkatkan dampak sosioekonomi.</p>
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
                    <h2>Buy and Hold</h2>
                    <p>Investasi jangka panjang sangat penting dalam proyek infrastruktur seperti internet di pedesaan karena membutuhkan waktu yang lama untuk membangun jaringan dan mencapai titik impas. Strategi ini mengurangi biaya transaksi dan menekankan pertumbuhan jangka panjang dari kenaikan nilai aset.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="image8" data-aos="fade-zoom-in" data-aos-delay="100">
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
                <div class="image9" data-aos="fade-zoom-in" data-aos-delay="100">
                    <img src="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-7 order-lg-2">
                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    <h2>Penggunaan Derivatif untuk Hedging</h2>
                    <p>Pada proyek investasi internet di pedesaan, derivatif keuangan dapat digunakan untuk mengelola risiko terkait dengan perubahan biaya material atau peralatan yang diperlukan untuk pembangunan infrastruktur, sehingga mengamankan harga pembelian atau penjualan di masa depan terhadap volatilitas harga.</p>
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