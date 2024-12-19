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
                    <div class="d-flex justify-content-end align-items-center mb-4">
                        <a href="{{ url('administrator/proyek-investasi/dokumentasi/data-create') }}" class="btn btn-primary">Tambahkan Dokumentasi</a>
                        <div id="tb_dokumentasi_filter" class="dataTables_filter"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tb_dokumentasi">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>Nama Proyek</th>
                                    <th>Gambar Dokumentasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumentasi as $d)
                                    <tr>
                                    <td>{{ $d->proyek->nama_proyek }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $d->file_url) }}">
                                            <img src="{{ asset('storage/' . $d->file_url) }}" class="img-thumbnail" alt="Dokumentasi Proyek">
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-icon" onclick="deleteData({{ $d->id_dokumentasi }})" title="Delete">
                                            <i class="ti-trash"></i>
                                        </button>
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
        $('#tb_dokumentasi').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true,
            "info": true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "order": [[0, "asc"]], 
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

    function deleteData(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang telah dihapus tidak dapat kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus data',
                    text: 'Mohon menunggu...',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                $.ajax({
                    url: "{{ url('administrator/proyek-investasi/dokumentasi/delete') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        Swal.fire(
                            'Terhapus!',
                            response.success,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Terjadi kesalahan!';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            }
        });
    }
</script>
@endsection