@extends('layout.app')

@section('title', 'Profile')

@section('content')
    <section class="section">
        <!--Header-->
        <div class="section-header">
            <h1>Profile</h1>
        </div>

        <?php
        $user = auth()->user();
        $profile = App\Models\Pengguna::where('email', $user->email)->first();
        ?>
        <!--Body-->
        <section class="section-body">
            <!--Alert Notification-->
            @include('layout.alert-notif')

            <div class="row">
                <div class="col-lg-12 card mb-4 ">
                    <div class="card-body">
                        <!-- Pastikan hanya ada satu atribut action dan method -->
                        <form method="POST" action="">
                            @csrf

                            <!--Nama-->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" value="{{ $profile->nama }}">
                                </div>
                            </div>

                            <!--Nomor Telepon-->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nomor_telepon"
                                        value="{{ $profile->nomor_telepon }}">
                                </div>
                            </div>

                            <!--Email-->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="{{ $profile->email }}" readonly="">
                                </div>
                            </div>

                            <!--Password-->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9 input-group">
                                    <input id="password" type="password" class="form-control" name="password"
                                        value="{{ $profile->password }}">

                                    <!--Show/Hide Password-->
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            onclick="togglePasswordVisibility('password', 'show_eye', 'hide_eye');">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!--Tombol Edit Profil-->
                            <div class="form-group row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
