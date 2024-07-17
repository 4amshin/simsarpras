@extends('layout.app')

@push('customCss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('title', 'Update Jadwal Berangkat')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Update Jadwal Berangkat</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('jadwalBerangkat.update', $jadwalBerangkat->id) }}">
                    @csrf
                    @method('PUT')

                    <!--Rute-->
                    <div class="form-group">
                        <label for="rute">Rute</label>
                        <select id="pilih_rute" class="form-control" name="rute">
                            <option value="">Pilih Rute...</option>
                            @foreach ($daftarRute as $rute)
                                <option value="{{ $rute }}"
                                    {{ $jadwalBerangkat->rute == $rute ? 'selected' : '' }}>{{ $rute }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--Bus-->
                    <div class="form-group">
                        <label for="id_bus">Bus</label>
                        <select id="id_bus_dropdown" class="form-control" name="id_bus">
                            <option value="">Pilih Bus...</option>
                            @foreach ($daftarBus as $bus)
                                <option value="{{ $bus->id }}"
                                    {{ $jadwalBerangkat->id_bus == $bus->id ? 'selected' : '' }}>
                                    {{ $bus->nomor_plat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!--Waktu Keberangakatn-->
                    <div class="form-group">
                        <label for="waktu_berangkat">Waktu Keberangakatan</label>
                        <input id="waktu_berangkat" type="text" class="form-control" name="waktu_berangkat"
                            value="{{ $jadwalBerangkat->waktu_berangkat }}" autofocus required>
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

@push('customJs')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#waktu_berangkat", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true
            });
        });
    </script>
@endpush
