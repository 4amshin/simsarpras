@extends('layout.app')

@section('title', 'Panduan Memesan Tiket')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Panduan Memesan Tiket</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    @can('super-user')
                        <a href="{{ route('informasi.edit', $caraPesan->id) }}" class="btn btn-primary btn-lg">Edit Panduan</a>
                    @endcan
                    @can('pengguna-only')
                        <h4>Panduan</h4>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="media">
                        <img class="mr-3" src="../assets/img/example-image-50.jpg" alt="Generic placeholder image">
                        <div class="media-body">
                            <h5 class="mt-0">Cara Memesan Tiket</h5>
                            <p class="mb-0">{{ $caraPesan->deskripsi }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
