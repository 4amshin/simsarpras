<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipetik</title>

    <!--Custom CSS-->
    <link rel="stylesheet" href="{{ asset('assets/css/home-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/table-style.css') }}">

    <!-- CSS Libraries -->
    @stack('customCss')



    <!--Google Fonts Link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="httpsQA://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rubik:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body id="top">
    <!--HEADER-->
    <header class="header active" data-header>
        <div class="container">

            <!--Logo-->
            @auth
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/home/rj-white.png') }}" width="120" alt="Logo Remaja Jaya">
                </a>
            @else
                <a href="/">
                    <img src="{{ asset('assets/img/home/rj-white.png') }}" width="120" alt="Logo Remaja Jaya">
                </a>
            @endauth

            <!--Navbar-->
            <nav class="navbar" data-navbar>

                <div class="navbar-top">
                    <a href="#" class="logo">Transportio</a>

                    <button class="nav-close-btn" aria-label="Clsoe menu" data-nav-toggler>
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                </div>

                <ul class="navbar-list">

                    <!--Menu Home-->
                    <li class="navbar-item">
                        <a href="/" class="navbar-link {{ url()->current() == url('/') ? 'active' : '' }}" data-nav-link>
                            <span>Home</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                    <!--Menu Tentang Kami-->
                    <li class="navbar-item ">
                        <a href="/about" class="navbar-link {{ Request::is('about*') ? 'active' : '' }}" data-nav-link>
                            <span>Tentang Kami</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>

                    <!--Menu Jadwal Bus-->
                    <li class="navbar-item ">
                        <a href="/jadwal" class="navbar-link {{ Request::is('jadwal*') ? 'active' : '' }}"
                            data-nav-link>
                            <span>Jadwal Bus</span>

                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </li>
                </ul>
            </nav>

            <button class="nav-open-btn" aria-label="Open menu" data-nav-toggler>
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <div class="overlay" data-nav-toggler data-overlay></div>
        </div>
    </header>

    <main>
        <article>
            <!--Content-->
            @yield('content')

        </article>
    </main>

    <footer class="footer">
        <div class="container">

            <div class="footer-top section">

                <div class="footer-brand">

                    @auth
                        <form method="POST" action="{{ route('informasi.updateSosmed') }}">
                            @csrf
                            <ul class="social-list">
                                <!--Facebook-->
                                <li>
                                    <a href="{{ $informasi['facebook'] }}" class="social-link">
                                        <ion-icon name="logo-facebook" role="img" class="md hydrated"
                                            aria-label="logo facebook"></ion-icon>
                                    </a>
                                </li>
                                <input class="hero-text sosmed" type="text" name="facebook"
                                    value="{{ $informasi['facebook'] }}">
                                <!--Facebook-->


                                <!--Email-->
                                <li>
                                    <a href="{{ $informasi['email'] }}" class="social-link">
                                        <ion-icon name="logo-google" role="img" class="md hydrated"
                                            aria-label="logo google"></ion-icon>
                                    </a>
                                </li>
                                <input class="hero-text sosmed" type="text" name="email"
                                    value="{{ $informasi['email'] }}">
                                <!--Email-->

                                <!--Instagram-->
                                <li>
                                    <a href="{{ $informasi['instagram'] }}" class="social-link">
                                        <ion-icon name="logo-instagram" role="img" class="md hydrated"
                                            aria-label="logo instagram"></ion-icon>
                                    </a>
                                </li>
                                <input class="hero-text sosmed" type="text" name="instagram"
                                    value="{{ $informasi['instagram'] }}">
                                <!--Instagram-->

                                <!--Whatsapp-->
                                <li>
                                    <a href="{{ $informasi['whatsapp'] }}" class="social-link">
                                        <ion-icon name="logo-whatsapp" role="img" class="md hydrated"
                                            aria-label="logo whatsapp"></ion-icon>
                                    </a>
                                </li>
                                <input class="hero-text sosmed" type="text" name="whatsapp"
                                    value="{{ $informasi['whatsapp'] }}">
                                <!--Whatsapp-->

                            </ul>
                            <button type="submit" class="btn">Simpan Perubahan</button>
                        </form>
                    @else
                        <ul class="social-list">
                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-facebook" role="img" class="md hydrated"
                                        aria-label="logo facebook"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-google" role="img" class="md hydrated"
                                        aria-label="logo google"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-instagram" role="img" class="md hydrated"
                                        aria-label="logo instagram"></ion-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-whatsapp" role="img" class="md hydrated"
                                        aria-label="logo whatsapp"></ion-icon>
                                </a>
                            </li>

                        </ul>
                    @endauth

                </div>

            </div>

            <div class="footer-bottom">
                <p class="copyright">
                    © 2024 Remaja Jaya
                </p>
            </div>

        </div>
    </footer>


    <!--Back To Top-->
    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
        <ion-icon name="chevron-up"></ion-icon>
    </a>

    <!--Custom JS-->
    <script src="{{ asset('assets/js/home-script.js') }}" defer></script>
    <script src="{{ asset('assets/js/table-script.js') }}" defer></script>

    <!-- JS Libraies -->
    @stack('customJs')

    <!--Icon Link-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
