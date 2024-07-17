@extends('layout.app')

@section('title', 'Daftar')


@section('content')
    <section class="section">
        <!--Header-->
        <div class="section-header">
            Daftar Tiket
        </div>

        <!--Body-->
        <div class="section-body">
             <!--Alert Notification-->
             @include('layout.alert-notif')

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

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
                                        <th>Kursi</th>
                                    </tr>

                                    @forelse ($daftarTiket as $index => $tiket)
                                        <tr>
                                            <td>
                                                {{ $index + $daftarTiket->firstItem() }}
                                            </td>
                                            @can('super-user')
                                                <td>
                                                    {{ $tiket->nama_penumpang }}
                                                </td>
                                                <td>
                                                    {{ $tiket->nomor_telepon }}
                                                </td>
                                            @endcan
                                            <td>
                                                {{ $tiket->jadwalBerangkat->bus->nama_bus }}
                                            </td>
                                            <td>
                                                {{ $tiket->jadwalBerangkat->rute }}
                                            </td>
                                            <td>
                                                {{ $tiket->titik_penjemputan }}
                                            </td>
                                            <td>
                                                {{ $tiket->tujuan }}
                                            </td>
                                            <td>
                                                {{ formatWaktuBerangkat($tiket->jadwalBerangkat->waktu_berangkat) }}
                                            </td>
                                            <td>
                                                {{ implode(', ', json_decode($tiket->kursi_diPesan)) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('tiket', $tiket->id) }}" class="btn btn-primary">Tiket</a>
                                            </td>
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
                                        {{ $daftarTiket->withQueryString()->links() }}
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
