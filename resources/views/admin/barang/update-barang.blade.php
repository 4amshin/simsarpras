@extends('layout.app')

@section('title', 'Update Barang')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Barang</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('barang.update', $barang->id) }}">
                    @csrf
                    @method('PUT')

                    <!--Nama & Lokasi Barang-->
                    <div class="row">
                        <!--Nama Barang-->
                        <div class="form-group col-6">
                            <label for="nama_barang">Nama Barang</label>
                            <input id="nama_barang" type="text" class="form-control" name="nama_barang"
                                value="{{ $barang->nama_barang }}" autofocus required>
                        </div>

                        <!--Lokasi Barang-->
                        <div class="form-group col-6">
                            <label for="lokasi_barang">Lokasi Barang</label>
                            <input id="lokasi_barang" type="text" class="form-control" name="lokasi_barang"
                                value="{{ $barang->lokasi_barang }}" autofocus required>
                        </div>
                    </div>

                    <!--Kondisi & Keterangan Barang-->
                    <div class="row">
                        <!--Kondisi Barang-->
                        <div class="form-group col-6">
                            <label class="form-label">Kondisi Barang</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi_barang" value="bagus" class="selectgroup-input"
                                        {{ $barang->kondisi_barang == 'bagus' ? 'checked' : '' }}>
                                    <span class="selectgroup-button">Bagus</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi_barang" value="rusak" class="selectgroup-input"
                                        {{ $barang->kondisi_barang == 'rusak' ? 'checked' : '' }}>
                                    <span class="selectgroup-button">Rusak</span>
                                </label>
                            </div>
                        </div>

                        <!--Keterangan-->
                        <div class="form-group col-6">
                            <label for="keterangan">Keterangan</label>
                            <input id="keterangan" type="text" class="form-control" name="keterangan"
                                value="{{ $barang->keterangan }}" autofocus required>
                        </div>
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
