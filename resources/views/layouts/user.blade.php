<!doctype html>
<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Links of CSS files -->
        <link rel="stylesheet" href="{{ asset('assets/css/aos.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/boxicons.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/header.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <title>VestNet - Investasi Internet Desa</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/all-img/favicon.png')}}">
    </head>
    <body>

        <!-- preloader -->
        <div class="preloader-container" id="preloader">
            <div class="preloader-dot"></div>
            <div class="preloader-dot"></div>
            <div class="preloader-dot"></div>
            <div class="preloader-dot"></div>
            <div class="preloader-dot"></div>
        </div>
        <!-- preloader -->

       <!-- Start Navbar Area Start -->
       <div class="navbar-area style-2" id="navbar">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/home">
                    <img class="logo-light" src="{{ asset('assets/img/logo/white-logo.png')}}" alt="logo">
                    <img class="logo-dark" src="{{ asset('assets/img/logo/logo.png')}}" alt="logo">
                </a>
                <div class="other-option d-lg-none">
                    <div class="option-item">
                        <button type="button" class="search-btn" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </div>
                <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button" aria-controls="navbarOffcanvas">
                    <i class='bx bx-menu'></i>
                </a>
                <div class="collapse navbar-collapse justify-content-between">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="/home" class="nav-link {{ isset($title) && $title === "home" ? 'active' : '' }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/proyek-investasi" class="nav-link {{ isset($title) && $title === "proyek"? "active": "" }}">
                                Proyek Investasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/simulasi-keuntungan" class="nav-link {{ isset($title) && $title === "simulasi"? "active": "" }}">
                                Simulasi Keuntungan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kalkulator" class="nav-link {{ isset($title) && $title === "kalkulator"? "active": "" }}">
                                Kalkulator Investasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tentang-kami" class="nav-link {{ isset($title) && $title === "tentang"? "active": "" }}">
                                Tentang Kami
                            </a>
                        </li>
                    </ul>
                    <div class="others-option d-flex align-items-center">
                        <div class="option-item">
                            <div class="nav-btn">
                                <a href="/edukasi" class="default-btn">Apa itu Investasi Internet?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
       </div>
       <!-- End Navbar Area Start -->

        <!-- Start Responsive Navbar Area -->
        <div class="responsive-navbar offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="navbarOffcanvas">
            <div class="offcanvas-header">
                <a href="index.html" class="logo d-inline-block">
                    <img class="logo-light" src="{{ asset('assets/img/logo/logo.png')}}" alt="logo">
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="accordion" id="navbarAccordion">
                    <div class="accordion-item">
                        <a class="accordion-link without-icon" href="/home">
                            Home
                        </a>
                    </div>
                    <div class="accordion-item">
                        <a class="accordion-link without-icon" href="/proyek-investasi">
                            Proyek Investasi
                        </a>
                    </div>
                    <div class="accordion-item">
                        <a class="accordion-link without-icon" href="/simulasi-keuntungan">
                            Simulasi Keuntungan
                        </a>
                    </div>
                    <div class="accordion-item">
                        <a class="accordion-link without-icon" href="/kalkulator">
                            Kalkulator Investasi
                        </a>
                    </div>
                    <div class="accordion-item">
                        <a class="accordion-link without-icon" href="/tentang-kami">
                            Tentang Kami
                        </a>
                    </div>
                </div>
                <div class="offcanvas-contact-info">
                <div class="offcanvas-other-options">
                    <div class="option-item">
                        <a href="/edukasi" class="default-btn">Apa itu Investasi Internet?</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- End Responsive Navbar Area -->
    @yield('content')
        <!-- Start Footer Area -->
        <div class="footer-area">
            <div class="footer-widget-info ptb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-md-6">
                            <div class="footer-widget">
                                <h4>Link Terkait</h4>
                                <ul>
                                    <li><a href="/tentang-kami">Tentang Kami</a></li>
                                    <li><a href="#">Kebijakan Privasi</a></li>
                                    <li><a href="#">Ketentuan Pengguna</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-6">
                            <div class="footer-widget">
                                <h4>Kontak</h4>
                                <ul>
                                    <li>
                                        <img class="icon-small" src="{{ asset('assets/img/icon/whatsapp.png')}}"><a href="https://wa.me/083861673722" class="text-footer">  +6283861673722</a>
                                    </li>
                                    <li>
                                        <img class="icon-small" src="{{ asset('assets/img/icon/email.png')}}"><a href="mailto:data@satriatech.com" class="text-footer">    data@satriatech.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-6">
                            <div class="footer-widget">
                                <h4>Alamat</h4>
                                <ul>
                                    <li>
                                        <img class="icon-map" src="{{ asset('assets/img/icon/map.png')}}"><a href="https://maps.app.goo.gl/PoGRDZMivihUsZJJ9" class="text-footer">  Jl. DI Panjaitan No.128, Karangreja, Purwokerto Kidul, Kec. Purwokerto Sel., Kabupaten Banyumas</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-6">
                            <div class="footer-widget">
                                <h4>Download VestNet</h4>
                                <div class="download_from">
                                    <a href="https://play.google.com/store/" target="_blank">
                                        <img src="{{ asset('assets/img/icon/playstore.png')}}" class="img-small" alt="google play"></a>
                                        <a href="https://apps.apple.com/" target="_blank">
                                            <img src="{{ asset('assets/img/icon/appstore.png')}}" class="img-small" alt="app store"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right-area style-2">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="cpr-left">
                                <p>Copyright© <a href="#">VestNet</a>, All rights reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="cpr-right">
                                <p>Sosial Media Kami:</p>
                                <ul class="social-list">
                                    <li><a href="#"><i class='bx bxl-facebook'></i></a></li>
                                    <li><a href="#"><i class='bx bxl-instagram-alt'></i></a></li>
                                    <li><a href="#"><i class='bx bxl-linkedin-square'></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="copy-logo">
                        <img src="{{ asset('assets/img/logo/footer-Logo.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Area -->

        <div class="go-top active">
            <i class="bx bx-up-arrow-alt"></i>
        </div>

        <!-- Links of JS files -->
        <script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/js/aos.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/js/magnific-popup.min.js')}}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('assets/js/main.js')}}"></script>
        {{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script> --}}
        </body>
        </html>