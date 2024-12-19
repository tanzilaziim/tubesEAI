@extends('admin.master')
@section('title')
    {{ @$title }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Selamat datang {{ Auth::user()->username }},</h3>
                        <h6 class="font-weight-normal mb-0">
                            Apa kabar anda hari ini?
                        </h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <div class="btn btn-sm btn-light bg-white" aria-haspopup="true">
                                    <i class="mdi mdi-calendar"></i>Hari Ini {{ date('d M Y') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="{{ asset('assets/admin/images/dashboard/people.png') }}" alt="people">
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent" onclick="fotoBtn()">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">User</p>
                                <p class="fs-30 mb-2">{{ $data['userCount'] }}</p>
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="col-md-6 mb-4 stretch-card transparent" onclick="audioBtn()">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Investor</p>
                                <p class="fs-30 mb-2">{{ $data['investorCount'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent" onclick="vidioBtn()">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Pelanggan Internet</p>
                                <p class="fs-30 mb-2">{{ $data['pelangganCount'] }}</p>
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="col-md-6 mb-4 stretch-card transparent" onclick="materialBtn()">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Proyek Investasi</p>
                                <p class="fs-30 mb-2">{{ $data['proyekCount'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent" onclick="blogBtn()">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Proyek Selesai</p>
                                <p class="fs-3 mb-2">{{ $data['proyekSelesaiCount'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent" onclick="eventBtn()">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Pengajuan Desa</p>
                                <p class="fs-30 mb-2">{{ $data['pengajuanDesaCount'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
{{-- 
    @section('js')
        <script>
            $.ajax({
                url: "{{ url('admin/data-analitic') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    var tanggal = response.data.map(function(e) {
                        return e.date
                    })
                    var data_i = response.data.map(function(e) {
                        return e.visitors
                    })
                    var ctx = document.getElementById('chart_analitic').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'line',

                        data: {
                            labels: tanggal,
                            datasets: [{
                                label: 'Visitor',
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                                data: data_i,
                            }]
                        },
                        options: {}
                    });
                    Swal.close();
                },
            });

            function fotoBtn() {
                window.open("{{ url('admin/galery/photo') }}");
            }

            function audioBtn() {
                window.open("{{ url('admin/galery/video') }}");
            }

            function vidioBtn() {
                window.open("{{ url('admin/galery/audio') }}");
            }

            function materialBtn() {
                window.open("{{ url('admin/galery/material') }}");
            }

            function blogBtn() {
                window.open("{{ url('admin/galery/blog') }}");
            }

            function eventBtn() {
                window.open("{{ url('admin/galery/event') }}");
            }
        </script>
@endsection --}}
