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
                        @if (Session::has('success'))
                            <div class="row grid-margin">
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span>{{ Session::get('success') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="row grid-margin">
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span>{{ Session::get('error') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tb_pengajuan">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>No</th>
                                    <th>Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>
                                    <th>Kepala Desa</th>
                                    <th>Nomor WhatsApp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengajuan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_desa }}</td>
                                        <td>{{ $item->kecamatan }}</td>
                                        <td>{{ $item->kabupaten }}</td>                                
                                        <td>{{ $item->kepala_desa }}</td>
                                        <td>
                                            <a href="https://wa.me/{{ $item->nomor_wa }}" target="_blank">
                                                {{ $item->nomor_wa }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button type="button" class="btn btn-primary btn-icon" onclick="pageDetail({{ $item->id_pengajuan }})" title="Detail">
                                                    <i class="ti-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-icon" onclick="deleteData({{ $item->id_pengajuan }})" title="Delete">
                                                    <i class="ti-trash"></i>
                                                </button>
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
        $('#tb_pengajuan').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true,
            "info": true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            },
            "dom": '<"d-flex justify-content-between align-items-center"lf>t<"d-flex justify-content-between align-items-center"ip>'
        });
    });

    function pageDetail(id) {
        location.replace("{{ url('administrator/pengajuan-desa/data-detail') }}/" + id);
    }

    function deleteData(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
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
                });
                $.ajax({
                    url: "{{ url('administrator/pengajuan-desa/data-delete') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan!'
                        });
                    }
                });
            }
        });
    }
</script>
@endsection
