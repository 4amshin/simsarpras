@extends('layout.app')

@section('title', 'Tambah Barang')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Tambah Barang</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('barang.store') }}">
                    @csrf

                    <div class="row">
                        <!--Nama Barang-->
                        <div class="form-group col-6">
                            <label for="nama_barang">Nama Barang</label>
                            <input id="nama_barang" type="text" class="form-control" name="nama_barang" autofocus
                                required>
                        </div>

                        <!--Lokasi Barang-->
                        <div class="form-group col-6">
                            <label for="lokasi_barang">Lokasi Barang</label>
                            <input id="lokasi_barang" type="text" class="form-control" name="lokasi_barang" autofocus
                                required>
                        </div>
                    </div>

                    <!--Keterangan-->
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input id="keterangan" type="text" class="form-control" name="keterangan" autofocus required>
                    </div>

                    <!--Tombol Simpan-->
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
