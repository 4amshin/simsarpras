@extends('layout.app')

@section('title', 'Daftar Bus')

@section('content')
    <section class="section">
        <!--Header-->
        <div class="section-header">
            <h1>Daftar Bus</h1>
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
                                <!--Tombol Tambah Bus-->
                                <div class="float-left">
                                    <a href="{{ route('bus.create') }}" class="btn btn-primary btn-lg">Tambah Bus</a>
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
                                        <th>Nomor Plat Bus</th>
                                        <th>Perwakilan</th>
                                        <th>Kapasitas</th>
                                        <th>Kursi VIP</th>
                                        <th>Kursi Premium</th>
                                        @can('super-user')
                                            <th>Aksi</th>
                                        @endcan
                                    </tr>

                                    @forelse ($daftarBus as $index => $bus)
                                        <tr>
                                            <td>
                                                {{ $index + $daftarBus->firstItem() }}
                                            </td>
                                            <td>
                                                {{ $bus->nomor_plat }}
                                            </td>
                                            <td>
                                                {{ $bus->lokasi_perwakilan }}
                                            </td>
                                            <td>
                                                {{ $bus->kapasitas }} Kursi
                                            </td>

                                            <td>
                                                Rp{{ number_format($bus->harga_kursi_vip, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                Rp{{ number_format($bus->harga_kursi_premium, 0, ',', '.') }}
                                            </td>

                                            @can('super-user')
                                                <td>
                                                    <div class="row">
                                                        <!--Tombol Update-->
                                                        <a href="{{ route('bus.edit', $bus->id) }}" class="btn btn-primary">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <div style="width: 10px;"></div>

                                                        <!--Tombol Hapus-->
                                                        <form action="{{ route('bus.destroy', $bus->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" id="delete-confirm">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </form>
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
                                        {{ $daftarBus->withQueryString()->links() }}
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
