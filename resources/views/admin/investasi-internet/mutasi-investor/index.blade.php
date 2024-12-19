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
                    <div class="table-responsive">
                        <table class="table table-striped" id="tb_investor">
                            <thead>
                                <tr class="btn-primary text-white">
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Kredit</th>
                                    <th>Debit</th>
                                    <th>Saldo</th>
                                    <th>Jumlah Proyek Investasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investors as $investor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $investor->nama_lengkap }}</td>
                                        <td>{{ formatRupiah($investor->kredit) }}</td>
                                        <td>{{ formatRupiah($investor->debit) }}</td>
                                        <td>{{ formatRupiah($investor->saldo_akhir) }}</td>
                                        <td>{{ $investor->proyek_count }}</td>
                                        <td>
                                            <a href="{{ url('administrator/investasi-internet/mutasi-investor/detail', $investor->id_user) }}" class="btn btn-primary btn-icon" title="Lihat Detail">
                                                <i class="ti-eye"></i>
                                            </a>
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
        $('#tb_investor').DataTable({
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
</script>
@endsection
