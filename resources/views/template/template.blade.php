<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SPK &mdash; SMK PGRI 2 GIRI</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('foto/pgri-noBG.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="#" class="navbar-brand sidebar-gone-hide">
                    SPK&mdash;SMK PGRI 2 GIRI
                </a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i
                        class="fas fa-bars"></i></a>
                <div class="nav-collapse">
                </div>
                <form class="form-inline ml-auto">
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('template') }}/assets/img/avatar/avatar-1.png"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            @include('template.nav')

            <!-- Main Content -->
            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2023 <div class="bullet"></div> Created By <a
                        href="https://www.instagram.com/khosyrh/">Khosy Robbin Hood</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('template') }}/assets/modules/jquery.min.js"></script>
    <script src="{{ asset('template') }}/assets/modules/popper.js"></script>
    <script src="{{ asset('template') }}/assets/modules/tooltip.js"></script>
    <script src="{{ asset('template') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('template') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('template') }}/assets/modules/moment.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('template') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('template') }}/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>
