@extends('layout.app')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('title', 'Pesan Tiket Bus')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Pesan Tiket Bus</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('pemesanan.pilihKursi') }}">
                    @csrf

                    <!--Rute-->
                    <div class="form-group">
                        <label for="rute">Rute</label>
                        <select id="rute_dropdown" class="form-control" name="rute">
                            <option value="">Pilih Rute...</option>
                            @foreach ($daftarRute as $rute)
                                <option value="{{ $rute }}">{{ $rute }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--Bus & Waktu Keberangakatan-->
                    <div class="row">
                        <!--Bus-->
                        <div class="form-group col-6">
                            <label for="id_bus">Bus</label>
                            <select id="id_bus_dropdown" class="form-control" name="id_bus">
                                <option value="">Pilih Bus...</option>
                                @foreach ($daftarBus as $bus)
                                    <option value="{{ $bus->id }}">
                                        {{ $bus->nama_bus }} {{ $bus->warna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!--Waktu Keberangakatan-->
                        <div class="form-group col-6">
                            <label for="waktu_berangkat">Waktu Keberangkatan</label>
                            <select id="waktu_berangkat" class="form-control" name="waktu_berangkat" required>
                                <option value="">Pilih Waktu...</option>
                            </select>
                        </div>
                    </div>

                    <!--Titik Penjemputan & Tujuan-->
                    <div class="row">
                        <!--Titik Penjemputan-->
                        <div class="form-group col-6">
                            <label for="titik_penjemputan">Titik Penjemputan</label>
                            <input id="titik_penjemputan" type="text" class="form-control" name="titik_penjemputan"
                                autofocus required>
                        </div>

                        <!--Tujuan-->
                        <div class="form-group col-6">
                            <label for="tujuan">Tujuan</label>
                            <input id="tujuan" type="text" class="form-control" name="tujuan" autofocus required>
                        </div>
                    </div>

                    <!--Tombol Pilih Kursi-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Pilih Kursi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
