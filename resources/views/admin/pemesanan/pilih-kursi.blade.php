@extends('layout.app')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('title', 'Pilih Kursi Bus')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Pilih Kursi Bus</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('pemesanan.store') }}">
                    @csrf

                    <!--ID Jadwal Berangkat-->
                    <input type="hidden" name="id_jadwalBerangkat" id="id_jadwalBerangkat" value="{{ $jadwal->id }}">

                    <!--Input Nama Penumpang & Nomor Telepon Untuk Admin-->
                    @can('super-user')
                        <div class="row">
                            <!--Nama-->
                            <div class="form-group col-6">
                                <label for="nama_penumpang">Nama Penumpang</label>
                                <input id="nama_penumpang" type="text" class="form-control" name="nama_penumpang" autofocus
                                    required>
                            </div>

                            <!--Nomor Telepon-->
                            <div class="form-group col-6">
                                <label for="nomor_telepon">Nomor Telepon (Whatsapp)</label>
                                <input id="nomor_telepon" type="text" class="form-control" name="nomor_telepon" autofocus
                                    required>
                            </div>
                        </div>
                    @endcan

                    <!--Titik Penjemputan & Tujuan-->
                    <div class="row">
                        <!--Titik Penjemputan-->
                        <div class="form-group col-6">
                            <label for="titik_penjemputan">Titik Penjemputan</label>
                            <input id="titik_penjemputan" type="text" class="form-control" name="titik_penjemputan"
                                value="{{ $titikPenjemputan }}" readonly>
                        </div>

                        <!--Tujuan-->
                        <div class="form-group col-6">
                            <label for="tujuan">Tujuan</label>
                            <input id="tujuan" type="text" class="form-control" name="tujuan"
                                value="{{ $tujuan }}" readonly>
                        </div>
                    </div>

                    <!--Bus & Waktu Keberangakatan-->
                    <div class="row">
                        <!--Bus-->
                        <div class="form-group col-6">
                            <label>Bus</label>
                            <input type="text" class="form-control"
                                value="{{ $jadwal->bus->nama_bus }}  {{ $jadwal->bus->warna }}" readonly>
                        </div>

                        <!--Waktu Keberangkatan-->
                        <div class="form-group col-6">
                            <label>Waktu Keberangkatan</label>
                            <input type="text" class="form-control" value="{{ $jadwal->waktu_berangkat }}" readonly>
                        </div>
                    </div>

                    <!--Pemilihan Kursi & Harga Total-->
                    <div class="row">
                        <div class="col-6">
                            <!--Label-->
                            <label for="kursi_diPesan">Pilih Kursi</label>

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
                                        $isBooked = in_array($i, $kursiTerbooking); // Contoh kursi yang sudah dibooking
                                        $class = 'seat';
                                        if ($isBooked) {
                                            $class .= ' booked';
                                        } elseif ($i <= $jadwal->bus->kursi_vip) {
                                            $class .= ' vip';
                                        } else {
                                            $class .= ' premium';
                                        }
                                    @endphp
                                    <div class="{{ $class }}" data-seat="{{ $i }}">{{ $i }}
                                    </div>
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
                                <img src="{{ asset('assets/img/home/kursi-bus-mangkutana.png') }}" alt="Banner"
                                    width="300" class="img-fluid">
                            @elseif ($jadwal->bus->lokasi_perwakilan == 'Bone-Bone')
                                <img src="{{ asset('assets/img/home/kursi-bus-bone.png') }}" alt="Banner" width="300"
                                    class="img-fluid">
                            @endif

                        </div>
                    </div>

                    <!--Harga Total-->
                    <div class="form-group">
                        <label>Total Harga</label>
                        <div id="selected_seats">
                            <!-- Daftar kursi yang dipilih akan muncul di sini -->
                        </div>
                        <hr>
                        <div id="total_price">
                            <!-- Total harga akan muncul di sini -->
                        </div>
                    </div>

                    <!-- Input tersembunyi -->
                    <input type="hidden" name="kursi_diPesan" id="kursi_diPesan">
                    <input type="hidden" name="harga_total" id="harga_total">

                    <!--Tombol Pesan Tiket-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Pesan Tiket</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seats = document.querySelectorAll('#seat_selection .seat');
            const selectedSeatsContainer = document.getElementById('selected_seats');
            const totalPriceContainer = document.getElementById('total_price');
            const hiddenSeatsInput = document.getElementById('kursi_diPesan');
            const hiddenTotalPriceInput = document.getElementById('harga_total');

            let selectedSeats = [];
            let totalVIP = 0;
            let totalPremium = 0;

            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    if (!seat.classList.contains('booked')) {
                        seat.classList.toggle('selected');

                        const seatNumber = parseInt(seat.textContent);
                        if (seat.classList.contains('selected')) {
                            selectedSeats.push(seatNumber);
                            if (seat.classList.contains('vip')) {
                                totalVIP++;
                            } else if (seat.classList.contains('premium')) {
                                totalPremium++;
                            }
                        } else {
                            selectedSeats = selectedSeats.filter(number => number !== seatNumber);
                            if (seat.classList.contains('vip')) {
                                totalVIP--;
                            } else if (seat.classList.contains('premium')) {
                                totalPremium--;
                            }
                        }

                        const hargaVip = {{ $jadwal->bus->harga_kursi_vip }};
                        const hargaPremium = {{ $jadwal->bus->harga_kursi_premium }};
                        const totalPrice = totalVIP * hargaVip + totalPremium * hargaPremium;

                        selectedSeatsContainer.innerHTML =
                            `Kursi yang dipilih: ${selectedSeats.join(', ')}`;
                        totalPriceContainer.innerHTML =
                            `Total harga: Rp ${totalPrice.toLocaleString('id-ID')}`;

                        hiddenSeatsInput.value = JSON.stringify(selectedSeats);
                        hiddenTotalPriceInput.value = totalPrice;
                    }
                });
            });
        });
    </script>
@endpush
