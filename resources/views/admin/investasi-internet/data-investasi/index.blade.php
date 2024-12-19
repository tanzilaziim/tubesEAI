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
                    <div class="table-responsive">
                        <table class="table table-striped" id="tb_investasi">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama Investor</th>
                                    <th>Nama Proyek</th>
                                    <th>Total Investasi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investasi as $inv)
                                    @if($inv->verified_user == 1)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inv->id_investasi }}</td>
                                        <td>{{ $inv->nama_lengkap }}</td>
                                        <td>{{ $inv->nama_proyek }}</td>
                                        <td>{{ formatRupiah($inv->total_investasi) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->tanggal)->format('d-m-Y') }}</td>
                                        <td>
                                        @if($inv->verify == 0)
                                            <div class="button-container">
                                                <button type="button" class="btn btn-primary btn-icon" onclick="pageVerify({{ $inv->id_investasi }})" title="tinjau pengajuan">
                                                    <i class="ti-check-box"></i>
                                                </button>                                             
                                            </div>                  
                                        @endif
                                        </td>
                                    </tr>
                                    @endif
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
        $('#tb_investasi').DataTable({
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

    function pageVerify(id) {
        location.replace("{{ url('administrator/investasi-internet/data-investasi/tinjau') }}/" + id);
    }
</script>
@endsection
