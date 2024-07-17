<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SIPETIK - TIKET</title>
    <link rel="stylesheet" href="{{ asset('assets/css/tiket.css') }}">
</head>

<body>
    <!-- partial:index.partial.html -->
    <link href="https://fonts.googleapis.com/css?family=Cabin|Indie+Flower|Inknut+Antiqua|Lora|Ravi+Prakash"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <div class="container">
        <h1 class="upcomming">TIKET</h1>

        @foreach (json_decode($pemesanan->kursi_diPesan) as $kursi)
            <div class="item">
                <div class="item-right">
                    <h2 class="num">{{ date('d', strtotime($pemesanan->jadwalBerangkat->waktu_berangkat)) }}</h2>
                    <p class="day">{{ date('M', strtotime($pemesanan->jadwalBerangkat->waktu_berangkat)) }}</p>
                    <span class="up-border"></span>
                    <span class="down-border"></span>
                </div> <!-- end item-right -->

                <div class="item-left">
                    <p class="event">{{ $pemesanan->nama_penumpang }}</p>
                    <h2 class="title">Kursi {{ $kursi }}</h2>

                    <div class="sce">
                        <div class="icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <p>{{ \Carbon\Carbon::parse($pemesanan->jadwalBerangkat->waktu_berangkat)->translatedFormat('l, d F Y') }}
                            <br />
                            {{ date('H:i A', strtotime($pemesanan->jadwalBerangkat->waktu_berangkat)) }}
                        </p>
                    </div>
                    <div class="fix"></div>
                    <div class="loc">
                        <div class="icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <p>{{ $pemesanan->jadwalBerangkat->rute }}
                            <br>
                            Bus {{ $pemesanan->jadwalBerangkat->bus->nama_bus }}
                            <br>
                            <strong>Tujuan {{ $pemesanan->tujuan }}</strong>

                        </p>
                    </div>
                    <div class="fix"></div>


                    @if ($kursi >= 1 && $kursi <= 6)
                        <button class="booked vip">KURSI VIP</button>
                    @elseif ($kursi >= 7 && $kursi <= 28)
                        <button class="booked premium">KURSI PREMIUM</button>
                    @endif

                    <div class="fix"></div>

                    <!--TOMBOL BATALAKAN TIKET-->
                    {{-- @can('super-user')
                    <form action="{{ route('batalkan.tiket', $pemesanan->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="nomor_kursi" value="{{ $kursi }}">
                        <button type="submit" class="cancel">
                            Batalkan
                        </button>
                    </form>
                    @endcan --}}
                    <!--TOMBOL BATALAKAN TIKET-->

                </div> <!-- end item-left -->
            </div> <!-- end item -->
        @endforeach

    </div>
</body>

</html>
