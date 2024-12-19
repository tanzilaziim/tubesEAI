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
                        <a href="{{ url('administrator/pengelolaan/aset/data-create') }}" class="btn btn-primary">Tambahkan data aset</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tb_aset">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>No</th>
                                    <th>Nama Aset</th>
                                    <th>Harga</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Batas Masa Manfaat</th>
                                    <th>Tanggal Update</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aset as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->nama_aset }}</td>
                                        <td>{{ formatRupiah($a->pembelianAset->biaya_satuan) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($a->tanggal_pembelian)->format('d-m-Y') }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($a->tanggal_pembelian)->addMonths($a->pembelianAset->masa_manfaat)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $a->tanggal_update ? \Carbon\Carbon::parse($a->tanggal_update)->format('d-m-Y') : '-' }}</td>
                                        <td>{{ $a->keterangan ?? '-' }}</td>
                                        <td>
                                            <div class="button-container">
                                                <button type="button" class="btn btn-primary btn-icon" onclick="pageEdit({{ $a->id_aset }})" title="Edit">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                {{-- <button type="button" class="btn btn-danger btn-icon" onclick="deleteData({{ $a->id_aset }})" title="Delete">
                                                    <i class="ti-trash"></i>
                                                </button> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div id="tb_aset_info" class="dataTables_info"></div>
                        <div id="tb_aset_length" class="dataTables_length"></div>
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
        $('#tb_aset').DataTable({
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

    function pageEdit(id) {
        location.replace("{{ url('administrator/pengelolaan/asset/edit') }}/" + id);
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
                })
                $.ajax({
                    url: "{{ url('administrator/pengelolaan/asset/delete') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        Swal.fire(
                            'Terhapus!',
                            response.message,
                            response.status === 'success' ? 'success' : 'error'
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