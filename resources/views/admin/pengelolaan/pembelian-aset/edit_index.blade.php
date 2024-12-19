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
                        <p class="card-description">Edit data pembelian aset yang diinginkan</p>

                        <form method="POST" action="{{ url('/administrator/pengelolaan/pembelian-aset/update', $pembelianAset->id_pembelian_aset) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nama_proyek">Nama Proyek</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{ $pembelianAset->proyek->nama_proyek }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nama_aset">Nama Aset</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="nama_aset" name="nama_aset" value="{{ $pembelianAset->nama_aset }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jumlah">Jumlah</label>
                                <div class="col-lg-8">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah', $pembelianAset->jumlah) }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="biaya_satuan">Biaya Satuan</label>
                                <div class="col-lg-8">
                                    <input type="number" class="form-control" id="biaya_satuan" name="biaya_satuan" value="{{ old('biaya_satuan', $pembelianAset->biaya_satuan) }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="masa_manfaat">Masa Manfaat</label>
                                <div class="col-lg-8">
                                    <input type="number" class="form-control" id="masa_manfaat" name="masa_manfaat" value="{{ old('masa_manfaat', $pembelianAset->masa_manfaat) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="bukti_pembayaran">Bukti Pembayaran</label>
                                <div class="col-lg-8">
                                    @if($pembelianAset->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $pembelianAset->bukti_pembayaran) }}">
                                            <img src="{{ asset('storage/' . $pembelianAset->bukti_pembayaran) }}" class="img-fluid" alt="Bukti Pembayaran">
                                        </a>
                                    @endif
                                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf">
                                    <p class="teks-format-file">*Hanya menerima file dengan format .jpg, .jpeg, .png, .pdf</p>
                                </div>
                            </div>
                            
                            <div class="template-demo d-flex justify-content-between flex-wrap">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ url('administrator/pengelolaan/pembelian-aset') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
