@extends('layouts.user')

@section('content')
<!-- Start Section Banner Area -->
<div class="section-banner bg-3">
    <div class="container">
        <div class="banner-spacing">
            <div class="section-info">
                <h2 data-aos="fade-up" data-aos-delay="100">Proyek Investasi</h2>
            </div>
        </div>
    </div>
</div>
<!-- End Section Banner Area -->
<div class="academics-area ptb-100" >
    <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <h3 class="title-anim">Jelajahi Proyek Kami</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="academics-item" style="border-color: var(--secounderyColor)" data-aos="fade-up" data-aos-delay="100">
                    <h4>Lokasi Strategis</h4>
                    <p>Setiap proyek yang kami pilih, terletak pada lokasi yang strategis dan dilaksanakan berdasarkan kebutuhan nyata masyarakat.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="academics-item" style="border-color: var(--secounderyColor)" data-aos="fade-up" data-aos-delay="200">
                    <h4>Transparansi Penuh</h4>
                    <p>Dari dana yang dibutuhkan hingga progres proyek, kami menyediakan semua informasi yang Anda butuhkan untuk membuat keputusan investasi yang tepat.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="academics-item" style="border-color: var(--secounderyColor)" data-aos="fade-up" data-aos-delay="300">
                    <h4>Estimasi ROI yang Menarik</h4>
                    <p>Nikmati potensi pengembalian investasi yang kompetitif sekaligus membantu membangun masa depan digital Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Keunggulan Vestnet -->
<!-- Start Courses Section Area -->
<div class="courses-section pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="grid-sorting">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-6">
                            <div class="title">
                                <h5>Proyek investasi internet desa yang tersedia</h5>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="select-box">
                                <div class="form-group">
                                    <label>Urutkan:</label>
                                    <form method="GET" action="{{ url()->current() }}">
                                        <select class="form-select" name="sort" onchange="this.form.submit()">
                                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                            <option value="location" {{ request('sort') == 'location' ? 'selected' : '' }}>Lokasi</option>
                                            <option value="value" {{ request('sort') == 'value' ? 'selected' : '' }}>Nilai</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($projects as $project)
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="course-item" data-aos="fade-up" data-aos-delay="100">
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
                        </div>
                    </div>
                    @endforeach
                </div>           
                <div class="blog-pagi">
                    <ul class="pagination">
                        {{ $projects->appends(request()->query())->links() }}
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-area">
                    <div class="widget widget-search">
                        <h3 class="widget-title">Pencarian</h3>
                        <form class="search-form" method="GET" action="{{ url()->current() }}">
                            <label>
                                <span class="screen-reader-text">Cari:</span>
                                <input type="search" class="search-field" name="search" placeholder="Cari..." value="{{ request('search') }}">
                            </label>
                            <button type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>

                    <div class="widget widget-catagories">
                        <h3 class="widget-title">Kategori</h3>
                        <ul>
                            @foreach(['Pendanaan selesai', 'Dalam pendanaan', 'Segera hadir'] as $status)
                                <li>
                                    <div class="radio-from">
                                        <input type="radio" id="status-{{ $loop->index }}" class="radio-input" name="status-group" value="{{ $status }}" {{ request('category') == $status ? 'checked' : '' }} onclick="filterByCategory('{{ $status }}')">
                                        <label for="status-{{ $loop->index }}" class="radio-label">
                                            <span class="radio-border"></span> {{ $status }}
                                        </label>
                                    </div>
                                    <span>({{ $projects->where('status', $status)->count() }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="widget widget-list location">
                        <h3 class="widget-title">Lokasi</h3>
                        <ul>
                            @foreach(['Banyumas', 'Purbalingga', 'Cilacap', 'Kebumen'] as $location)
                                <li>
                                    <div class="radio-from">
                                        <input type="radio" id="location-{{ $loop->index }}" class="radio-input" name="location-group" value="{{ $location }}" {{ request('location') == $location ? 'checked' : '' }} onclick="filterByLocation('{{ $location }}')">
                                        <label for="location-{{ $loop->index }}" class="radio-label">
                                            <span class="radio-border"></span>Kab. {{ $location }}
                                        </label>
                                    </div>
                                    <span>({{ $projects->where('kabupaten', $location)->count() }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>                   

                    <div class="widget widget-list faq">
                        <h3 class="widget-title">Tanya Jawab</h3>
                        <ul>
                            <li>
                                <div class="faq-item-2">
                                    <div class="faq-question-2" onclick="toggleFaq(6)">
                                        <span>Bagaimana cara memulai investasi di Vestnet?</span>
                                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="faq-answer-2" id="faq-6">
                                        Anda hanya dapat melakukan transaksi investasi internet melalui aplikasi mobile Vestnet.
                                        <br><br>
                                        <button class="contact-button-2" onclick="window.location.href='/download'">Download</button>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="faq-item-2">
                                    <div class="faq-question-2" onclick="toggleFaq(1)">
                                        <span>Bagaimana cara memilih proyek untuk berinvestasi?</span>
                                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="faq-answer-2" id="faq-1">
                                        Investor dapat memilih proyek berdasarkan lokasi, potensi pengembalian investasi, dan tingkat risiko. Setiap proyek di situs kami memiliki detail yang lengkap untuk membantu Anda membuat keputusan.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="faq-item-2">
                                    <div class="faq-question-2" onclick="toggleFaq(2)">
                                        <span>Bagaimana saya dapat memonitor investasi saya?</span>
                                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="faq-answer-2" id="faq-2">
                                        Anda dapat melacak kemajuan investasi Anda melalui dashboard pribadi Anda di website VestNet, yang menyediakan update reguler dan analisis kinerja.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="faq-item-2">
                                    <div class="faq-question-2" onclick="toggleFaq(3)">
                                        <span>Apa keuntungan berinvestasi melalui VestNet?</span>
                                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="faq-answer-2" id="faq-3">
                                        Investasi melalui VestNet tidak hanya menawarkan pengembalian finansial tetapi juga kesempatan untuk berkontribusi pada pembangunan infrastruktur vital dan pembangunan masyarakat di daerah pedesaan.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="faq-item-2">
                                    <div class="faq-question-2" onclick="toggleFaq(4)">
                                        <span>Bagaimana proses pembayaran dan penarikan dana berlangsung?</span>
                                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="faq-answer-2" id="faq-4">
                                        Pembayaran dapat dilakukan melalui berbagai metode, termasuk transfer bank dan e-wallet. Untuk penarikan dana, VestNet menyediakan prosedur yang mudah dan transparan, sesuai dengan ketentuan dan kondisi yang berlaku.
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="faq-item-2">
                                    <div class="faq-question-2" onclick="toggleFaq(5)">
                                        <span>Siapa yang dapat saya hubungi jika saya memiliki pertanyaan lebih lanjut?</span>
                                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="faq-answer-2" id="faq-5">
                                        Untuk pertanyaan lebih lanjut, Anda dapat menghubungi layanan pelanggan kami melalui email, telepon, atau fitur chat di website kami. Kami selalu siap membantu Anda.
                                        <br><br>
                                        <button class="contact-button-2" onclick="window.location.href='https://wa.me/083861673722'">Hubungi kami</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>                                                                                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Courses Section Area -->
@endsection

<script>
    function filterByCategory(status) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', status);
        window.location.href = url.toString();
    }

    function filterByLocation(location) {
        const url = new URL(window.location.href);
        url.searchParams.set('location', location);
        window.location.href = url.toString();
    }    

    function filterByGrade(grade) {
        const url = new URL(window.location.href);
        url.searchParams.set('grade', grade);
        window.location.href = url.toString();
    }

    function toggleFaq(index) {
        var faqItem = document.getElementById("faq-" + index).parentElement;
        var answer = document.getElementById("faq-" + index);
        var icon = faqItem.querySelector(".faq-icon");

        if (answer.style.display === "block") {
            answer.style.display = "none";
            faqItem.classList.remove("open");
        } else {
            answer.style.display = "block";
            faqItem.classList.add("open");
        }
    }
</script>