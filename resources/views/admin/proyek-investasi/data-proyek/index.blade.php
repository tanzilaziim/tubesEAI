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
                        <a href="{{ url('administrator/proyek-investasi/data-proyek/data-create') }}" class="btn btn-primary">Tambahkan Proyek</a>
                        <div id="tb_proyek_filter" class="dataTables_filter"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tb_proyek">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>Nama Proyek</th>
                                    <th>Dana Terkumpul</th>
                                    <th>Target Investasi</th>
                                    <th>Desa</th>
                                    <th>Kabupaten</th>
                                    <th>ROI</th>
                                    <th>Grade</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $project->nama_proyek }}</td>
                                        <td>{{ formatRupiah ($project->dana_terkumpul) }}</td>
                                        <td>{{ formatRupiah($project->target_invest) }}</td>
                                        <td>{{ $project->desa }}</td>
                                        <td>Kab. {{ $project->kabupaten }}</td>
                                        <td>{{ $project->roi }}%</td>
                                        <td>{{ $project->grade }}</td>
                                        <td>
                                        <div class="button-container">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning btn-icon dropdown-toggle" aria-expanded="false" onclick="showDropdown(event, {{ $project->id_proyek }})">
                                                    <i class="ti-settings"></i>
                                                </button>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div id="tb_proyek_info" class="dataTables_info"></div>
                        <div id="tb_proyek_length" class="dataTables_length"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Placeholder for dynamically appended dropdown menu -->
<div id="dynamic-dropdown-container"></div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tb_proyek').DataTable({
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

    function showDropdown(event, projectId) {
        event.stopPropagation();

        // Remove any existing dropdowns
        $('#dynamic-dropdown-container .dropdown-menu').remove();

        // Calculate the position of the button
        var button = $(event.currentTarget);
        var offset = button.offset();
        var buttonWidth = button.outerWidth();
        var dropdownTop = offset.top + button.outerHeight();
        var dropdownLeft = offset.left + buttonWidth;

        var dropdownHTML = `
            <ul class="dropdown-menu show custom-dropdown" style="position: absolute; top: ${dropdownTop}px; left: ${dropdownLeft}px; z-index: 1050; display: block;">
                <li>
                    <a class="dropdown-item" href="#" onclick="pageEdit(${projectId})">
                        <i class="ti-pencil-alt"></i> Edit
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="deleteData(${projectId})">
                        <i class="ti-trash"></i> Hapus
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="pageDetail(${projectId})">
                        <i class="ti-eye"></i> Detail
                    </a>
                </li>
            </ul>
        `;

        $('#dynamic-dropdown-container').append(dropdownHTML);
    }

    $(document).on('click', function() {
        $('#dynamic-dropdown-container .dropdown-menu').remove();
    });

    function pageEdit(id) {
        location.replace("{{ url('administrator/proyek-investasi/data-proyek/data-edit') }}/" + id);
    }

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
                    url: "{{ url('administrator/proyek-investasi/data-proyek/data-delete') }}",
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

    function pageDetail(id) {
        location.replace("{{ url('administrator/proyek-investasi/data-proyek/data-detail') }}/" + id);
    }
</script>
@endsection
