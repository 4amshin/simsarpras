@extends('layout.app')

@section('title', 'Edit Informasi')

@section('content')
    <!--Header-->
    <section class="section">
        <div class="section-header">
            <h1>Edit {{ $informasi->judul }}</h1>
        </div>
    </section>

    <!--Body-->
    <section class="section-body">
        @include('layout.alert-notif')

        <div class="card card-primary">
            <div class="card-body">
                <form method="POST" action="{{ route('informasi.update', $informasi->id) }}">
                    @csrf
                    @method('PUT')

                    <!--Judul-->
                    {{-- <div class="form-group">
                        <label for="judul">Judul</label>
                        <input id="judul" type="text" class="form-control" name="judul"
                            value="{{ $informasi->judul }}" autofocus required>
                    </div> --}}

                    <!--Deskripsi-->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" required style="height: 214px;">{{ $informasi->deskripsi }}</textarea>
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
