@extends('layout.app')

@section('title', 'Daftar')

<?php
$user = auth()->user();
?>

@section('content')
    <section class="section">
        <!--Header-->
        <div class="section-header">
            @if ($user->role === 'pengguna')
                <h1>Daftar Pesanan</h1>
            @else
                <h1>Daftar Pemesanan Tiket</h1>
            @endif
        </div>

        <!--Body-->
        <div class="section-body">
            @include('layout.alert-notif')

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!--Tombol Buat Pemesanan-->
                            @can('super-user')
                                <div class="float-left" style="margin-left: 10px;">
                                    <a href="{{ route('pemesanan.create') }}" class="btn btn-primary btn-lg">Buat Pemesanan</a>
                                </div>
                            @endcan

                            <!--Pencarian-->
                            <div class="float-right">
                                <form method="GET">
                                    <div class="input-group">
                                        <input name="search" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!--Spacer-->
                            <div class="clearfix mb-3"></div>

                            <!--Tabel-->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>No</th>
                                        @can('super-user')
                                            <th>Penumpang</th>
                                            <th>Nomor Telepon</th>
                                        @endcan
                                        <th>Bus</th>
                                        <th>Rute</th>
                                        <th>Titik Penjemputan</th>
                                        <th>Tujuan</th>
                                        <th>Waktu Keberangkatan</th>
                                        <th>Kursi DiPesan</th>
                                        <th>Harga Total</th>
                                        @can('super-user')
                                            <th>Pembayaran</th>
                                        @endcan
                                    </tr>

                                    @forelse ($daftarPemesanan as $index => $pemesanan)
                                        <tr>
                                            <td>
                                                {{ $index + $daftarPemesanan->firstItem() }}
                                            </td>
                                            @can('super-user')
                                                <td>
                                                    {{ $pemesanan->nama_penumpang }}
                                                </td>
                                                <td>
                                                    {{ $pemesanan->nomor_telepon }}
                                                </td>
                                            @endcan
                                            <td>
                                                {{ $pemesanan->jadwalBerangkat->bus->nama_bus }}
                                            </td>
                                            <td>
                                                {{ $pemesanan->jadwalBerangkat->rute }}
                                            </td>
                                            <td>
                                                {{ $pemesanan->titik_penjemputan }}
                                            </td>
                                            <td>
                                                {{ $pemesanan->tujuan }}
                                            </td>
                                            <td>
                                                {{ formatWaktuBerangkat($pemesanan->jadwalBerangkat->waktu_berangkat) }}
                                            </td>
                                            <td>
                                                {{ implode(', ', json_decode($pemesanan->kursi_diPesan)) }}
                                            </td>
                                            <td>
                                                Rp {{ number_format($pemesanan->harga_total, 0, ',', '.') }}
                                            </td>
                                            @can('pengguna-only')
                                                <td>
                                                    @if ($pemesanan->status == 'terkonfirmasi')
                                                        <span class="badge badge-success">
                                                            <i class="fa-solid fa-print"></i> Cetak Tiket
                                                        </span>
                                                    @elseif($pemesanan->status == 'diProses')
                                                        <span class="badge badge-warning">Di Proses</span>
                                                    @endif
                                                </td>
                                            @endcan


                                            @can('super-user')
                                                <td>
                                                    <div class="row">
                                                        @if ($pemesanan->status == 'terkonfirmasi')
                                                            <a href="#" class="badge badge-success">
                                                                <i class="fa-solid fa-print"></i> Cetak Tiket
                                                            </a>
                                                        @elseif($pemesanan->status == 'diProses')
                                                            <!--Tombol Konfirmais-->
                                                            <form
                                                                action="{{ route('pemesanan.konfirmasiPembayaran', $pemesanan->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fa-solid fa-check-double"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <div style="width: 10px;"></div>

                                                        <!--Tombol Tolak Pemesanan-->
                                                        @if ($pemesanan->status == 'diProses')
                                                            <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    id="delete-confirm">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Data Tidak Ditemukan</td>
                                        </tr>
                                    @endforelse

                                </table>
                            </div>

                            <!--Navigasi Halaman-->
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        {{ $daftarPemesanan->withQueryString()->links() }}
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
