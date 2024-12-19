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
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ $title }}</span></li>
                    </ol>
                </nav>
                <br>
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="form-group col-md-4">
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
                    </div>
                    <form action="{{ url('administrator/pengelolaan/tagihan') }}" method="GET">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="bulan">Pilih Bulan</label>
                                <input type="month" name="bulan" id="bulan" class="form-control" value="{{ $bulan }}">
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary">Terapkan</button>
                            </div>
                        </div>
                    </form>                                     
                    <div class="table-responsive">
                        <table class="table table-striped" id="tb_tagihan">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>No</th>
                                    <th>ID Pelanggan</th>
                                    <th>NIK</th>
                                    <th>Tanggal</th>
                                    <th>Tagihan</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tagihan as $tag)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tag->id_pelanggan }}</td>
                                        <td>{{ $tag->nik }}</td>
                                        <td>{{\Carbon\Carbon::parse($tag->tanggal)->format('d-m-Y')}}</td>
                                        <td>{{ formatRupiah($tag->tagihan) }}</td>
                                        <td>{{ $tag->metode_pembayaran }}</td>
                                        <td>
                                            @if($tag->bukti_pembayaran != NULL)
                                                <a href="{{ asset('storage/' . $tag->bukti_pembayaran) }}" target="_blank">Lihat</a>
                                            @endif
                                        </td>                                        
                                        <td>
                                            <div class="button-container"> 
                                                @if($tag->is_verified == 0)
                                                    @if($tag->bukti_pembayaran != NULL)
                                                        <div class="button-container">
                                                            <button type="button" class="btn btn-primary btn-icon" onclick="verifyTagihan({{ $tag->id_tagihan }})" title="Verifikasi Tagihan">
                                                                <i class="ti-check-box"></i>
                                                            </button>   
                                                        </div>  
                                                    @endif   
                                                    <button type="button" class="btn btn-danger btn-icon" onclick="pageEdit({{ $tag->id_tagihan }})" title="Edit">
                                                        <i class="ti-pencil-alt"></i>
                                                    </button>  
                                                @endif
                                            </div>                                   
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tb_tagihan').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true,
            "info": true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            },
            "dom": '<"d-flex justify-content-between align-items-center"lf>t<"d-flex justify-content-between align-items-center"ip>'
        });
    });

    function verifyTagihan(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang telah diverifikasi tidak dapat kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, verifikasi!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memverifikasi pembayaran',
                    text: 'Mohon menunggu...',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                $.ajax({
                    url: "{{ url('administrator/pengelolaan/tagihan/verifikasi') }}/" + id,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire(
                            'Terverifikasi!',
                            'Pembayaran telah diverifikasi.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr);  
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan!'
                        });
                    }
                });
            }
        });
    }

    function pageEdit(id) {
        location.replace("{{ url('administrator/pengelolaan/tagihan/edit') }}/" + id);
    }
</script>
@endsection
