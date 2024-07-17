@extends('layout.app')

@section('title', 'Daftar Jadwal Berangkat')

@section('content')
    <section class="section">
        <!--Header-->
        <div class="section-header">
            <h1>Daftar Jadwal Berangkat</h1>
        </div>

        <!--Body-->
        <div class="section-body">
            @include('layout.alert-notif')

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!--Tombol-->
                            @can('super-user')
                                <!--Tombol Tambah Jadwal Berangkat-->
                                <div class="float-left">
                                    <a href="{{ route('jadwalBerangkat.create') }}" class="btn btn-primary btn-lg">Tambah Jadwal
                                        Berangkat</a>
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
                                        <th>Rute</th>
                                        <th>Bus</th>
                                        <th>Jam Berangkat</th>
                                        <th>Status Perjalanan</th>
                                        <th>Kursi</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @forelse ($daftarJadwalBerangkat as $index => $jadwalBerangkat)
                                        <tr>
                                            <td>
                                                {{ $index + $daftarJadwalBerangkat->firstItem() }}
                                            </td>
                                            <td>
                                                {{ $jadwalBerangkat->rute }}
                                            </td>
                                            <td>
                                                {{ $jadwalBerangkat->bus->nomor_plat }}
                                            </td>
                                            <td>
                                                {{ formatWaktuBerangkat($jadwalBerangkat->waktu_berangkat) }}
                                            </td>
                                            <td>
                                                @if ($jadwalBerangkat->status_perjalanan == 'selesai')
                                                    <span class="badge badge-success">
                                                        Selesai
                                                    </span>
                                                @elseif($jadwalBerangkat->status_perjalanan == 'proses')
                                                    <span class="badge badge-warning">Dalam Perjalanan</span>
                                                @endif
                                            </td>

                                            <!--Tombol Lihat Kursi-->
                                            @if ($jadwalBerangkat->status_perjalanan == 'proses')
                                                <td>
                                                    <form action="{{ route('jadwalBerangkat.lihatKursi') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_bus"
                                                            value="{{ $jadwalBerangkat->id_bus }}">
                                                        <input type="hidden" name="waktu_berangkat"
                                                            value="{{ $jadwalBerangkat->waktu_berangkat }}">
                                                        <button type="submit" class="btn btn-light">Lihat Kursi</button>
                                                    </form>
                                                </td>
                                            @endif

                                            @can('super-user')
                                                @if ($jadwalBerangkat->status_perjalanan == 'proses')
                                                    <td>
                                                        <div class="row">
                                                            <!--Tombol Update-->
                                                            <a href="{{ route('jadwalBerangkat.edit', $jadwalBerangkat->id) }}"
                                                                class="btn btn-primary" data-toggle="tooltip" data-original-title="Edit Jadwal">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <div style="width: 10px;"></div>

                                                            <!--Tombol Konfirmais-->
                                                            <form
                                                                action="{{ route('jadwalBerangkat.selesai', $jadwalBerangkat->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-original-title="Tandai Jadwal Sebagai Selesai">
                                                                    <i class="fa-solid fa-check-double"></i>
                                                                </button>
                                                            </form>
                                                            <div style="width: 10px;"></div>

                                                            <!--Tombol Hapus-->
                                                            <form
                                                                action="{{ route('jadwalBerangkat.destroy', $jadwalBerangkat->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    id="delete-confirm" data-toggle="tooltip" data-original-title="Hapus Jadwal">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endif
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
                                        {{ $daftarJadwalBerangkat->withQueryString()->links() }}
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
