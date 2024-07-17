@extends('layout.app')

@section('title', 'Tambah Jadwal Jaga')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Tambah Jadwal Jaga</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        <div class="card card-primary">
            <div class="card-body">

                <form method="POST" action="{{ route('jadwal.store') }}">
                    @csrf

                    <!--Waktu Keberangakatn-->
                    <div class="form-group">
                        <label>Petugas Jaga</label>
                        <select class="form-control" name="pengguna_id">
                            <option>Pilih Admin</option>
                            @foreach ($listAdmin as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--Pilih Hari-->
                    <div class="form-group">
                        <label class="form-label">Pilih Hari</label>
                        <div class="selectgroup selectgroup-pills">
                            @foreach ($listHari as $hari)
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="hari[]" value="{{ $hari }}"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">{{ $hari }}</span>
                                </label>
                            @endforeach
                        </div>
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
