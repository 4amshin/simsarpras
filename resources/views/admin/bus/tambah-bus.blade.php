@extends('layout.app')

@section('title', 'Tambah Bus')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Tambah Bus</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('bus.store') }}">
                    @csrf

                    <!--Nomor Plat-->
                    <div class="form-group">
                        <label for="nomor_plat">Nomor Plat</label>
                        <input id="nomor_plat" type="text" class="form-control" name="nomor_plat" autofocus required>
                    </div>

                    <!--Lokasi-->
                    <div class="form-group">
                        <label for="lokasi">Lokasi Bus</label>
                        <input id="lokasi" type="text" class="form-control" name="lokasi_perwakilan" autofocus required>
                    </div>

                    <!--Kapasitas-->
                    <div class="form-group">
                        <label for="kapasitas">Kapasitas Bus</label>
                        <input id="kapasitas" type="text" class="form-control" name="kapasitas" autofocus required>
                    </div>

                    <!--Harga Kursi VIP & Premium-->
                    <div class="row">
                        <!--Harga Kursi VIP-->
                        <div class="form-group col-6">
                            <label>Harga Kursi VIP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">IDR</div>
                                </div>
                                <input type="text" name="harga_kursi_vip" class="form-control currency">
                            </div>
                        </div>

                        <!--Harga Kursi Premium-->
                        <div class="form-group col-6">
                            <label>Harga Kursi Premium</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">IDR</div>
                                </div>
                                <input type="text" name="harga_kursi_premium" class="form-control currency">
                            </div>
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
