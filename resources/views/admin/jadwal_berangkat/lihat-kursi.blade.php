@extends('layout.app')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('title', 'Kursi Bus')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>{{ $jadwal->rute }}</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">

                <!--Bus & Waktu Keberangkatan-->
                <div class="row">
                    <!--Bus-->
                    <div class="form-group col-6">
                        <label>Bus</label>
                        <input type="text" class="form-control"
                            value="{{ $jadwal->bus->nama_bus }} {{ $jadwal->bus->warna }}" readonly>
                    </div>

                    <!--Waktu Keberangkatan-->
                    <div class="form-group col-6">
                        <label>Waktu Keberangkatan</label>
                        <input type="text" class="form-control"
                            value="{{ formatWaktuBerangkat($jadwal->waktu_berangkat) }}" readonly>
                    </div>
                </div>

                <!--Pemilihan Kursi-->
                <div class="row">
                    <div class="col-6">
                        <!--Label-->
                        <label for="kursi_diPesan">Kursi Terbooking</label>

                        <!--Keterangan Warna-->
                        <div class="row mb-2">
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="color-box gray"></div>
                                    <span class="ml-2">Tidak Tersedia</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="color-box gold"></div>
                                    <span class="ml-2">VIP</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="color-box green"></div>
                                    <span class="ml-2">Premium</span>
                                </div>
                            </div>
                        </div>

                        <!--List Kotak-->
                        <div id="seat_selection" class="d-flex flex-wrap">
                            @for ($i = 1; $i <= $jadwal->bus->kapasitas; $i++)
                                @php
                                    $isBooked = in_array($i, $kursiTerbooking);
                                    $class = 'seat';
                                    if ($isBooked) {
                                        $class .= ' booked';
                                    } elseif ($i <= $jadwal->bus->kursi_vip) {
                                        $class .= ' vip';
                                    } else {
                                        $class .= ' premium';
                                    }
                                @endphp
                                <div class="{{ $class }}" data-seat="{{ $i }}">{{ $i }}</div>
                                @if ($i % 4 == 0)
                        </div><br>
                        <div id="seat_selection" class="d-flex flex-wrap">
                            @endif
                            @endfor
                        </div>
                    </div>

                    <!--Denah Bus-->
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        @if ($jadwal->bus->lokasi_perwakilan == 'Mangkutana')
                            <img src="{{ asset('assets/img/home/kursi-bus-mangkutana.png') }}" alt="Banner" width="300"
                                class="img-fluid">
                        @elseif ($jadwal->bus->lokasi_perwakilan == 'Bone-Bone')
                            <img src="{{ asset('assets/img/home/kursi-bus-bone.png') }}" alt="Banner" width="300"
                                class="img-fluid">
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('customJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seats = document.querySelectorAll('#seat_selection .seat');
            seats.forEach(seat => {
                if (seat.classList.contains('booked')) {
                    // seat.style.backgroundColor = 'gray';
                } else if (seat.classList.contains('vip')) {
                    // seat.style.backgroundColor = 'gold';
                } else if (seat.classList.contains('premium')) {
                    // seat.style.backgroundColor = 'green';
                }
            });
        });
    </script>
@endpush
