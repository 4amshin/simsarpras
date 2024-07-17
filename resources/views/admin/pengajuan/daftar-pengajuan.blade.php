@extends('layout.app')

@section('title', 'Daftar Pengajuan')

@section('content')
    <section class="section">
        <!--Header-->
        <div class="section-header">
            <h1>Daftar Pengajuan</h1>
        </div>

        <!--Body-->
        <div class="section-body">
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
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Pengaju</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Jenis Pengajuan</th>
                                        @can('super-user')
                                            <th>Aksi</th>
                                        @endcan
                                    </tr>

                                    @forelse ($daftarPengajuan as $index => $pengajuan)
                                        <tr>
                                            <td>
                                                {{ $index + $daftarPengajuan->firstItem() }}
                                            </td>
                                            <td>
                                                <span class="badge badge-light">{{ $pengajuan->barang->kode_barang }}</span>
                                            </td>
                                            <td>
                                                {{ $pengajuan->barang->nama_barang }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->pengguna->nama }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>
                                                @if ($pengajuan->jenis_pengajuan == 'perbaikan')
                                                    <span class="badge badge-info">Perbaikan</span>
                                                @elseif ($pengajuan->jenis_pengajuan == 'pergantian')
                                                    <span class="badge badge-primary">Pergantian</span>
                                                @endif
                                            </td>
                                            @can('super-user')
                                                <td>
                                                    <div class="row">
                                                        <!--Terima Pengajuan-->
                                                        <a href="{{ route('pengajuan.terima', $pengajuan->id) }}"
                                                            class="btn btn-primary" data-toggle="tooltip" data-original-title="Terima Pengajuan">
                                                            <i class="fa-solid fa-check-double"></i>
                                                        </a>

                                                        <div style="width: 10px;"></div>

                                                        <!--Tolak Pengajuan-->
                                                        <a href="{{ route('pengajuan.tolak', $pengajuan->id) }}"
                                                            class="btn btn-danger" data-toggle="tooltip" data-original-title="Tolak Pengajuan">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </a>
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
                                        {{ $daftarPengajuan->withQueryString()->links() }}
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
