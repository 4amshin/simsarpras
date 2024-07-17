@extends('layout.custom')

@section('title', 'Login Page')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <!--Logo-->
            <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <!--Main Body-->
            <div class="card card-primary">
                <!--Title-->
                <div class="card-header">
                    <h4>Login</h4>
                </div>

                <!--Body-->
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        @csrf

                        <!--Email-->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" tabindex="1" autofocus>

                            <!--Penampil Pesan Eror-->
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!--Password-->
                        <div class="form-group">
                             <!--Title-->
                             <label for="password" class="control-label">Password</label>

                            <!--Input-->
                            <div class="input-group">
                                <!--Input Field-->
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    tabindex="2">

                                <!--Show/Hide Password-->
                                <div class="input-group-append">
                                    <span class="input-group-text"
                                        onclick="togglePasswordVisibility('password', 'show_eye', 'hide_eye');">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>

                            <!--Penampil Pesan Error-->
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!--Tombol Login-->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!--Footer-->
            <div class="simple-footer">
                Copyright &copy; SIMSARPRAS 2024

            </div>
        </div>
    </div>
@endsection
