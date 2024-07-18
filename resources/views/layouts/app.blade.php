<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @auth
        <div id="app" class="d-flex side-bar">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-dark-navy" style="width: 280px;">
                <a href="/home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4">MyRecruit</span>
                </a>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="/home  " class="nav-link d-flex align-items-center gap-2 text-white active mt-4"
                            aria-current="page">
                            @include('icons/home')
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/kriteria" class="nav-link d-flex align-items-center gap-2 text-white mt-4"
                            aria-current="page">
                            @include('icons/home')
                            Kriteria
                        </a>
                    </li>
                    <li>
                        <a href="/subkriteria" class="nav-link d-flex align-items-center gap-2 text-white mt-4"
                            aria-current="page">
                            @include('icons/home')
                            Sub Kriteria
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link d-flex align-items-center gap-2 text-white mt-4"
                            aria-current="page">
                            @include('icons/home')
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link d-flex align-items-center gap-2 text-white mt-4"
                            aria-current="page">
                            @include('icons/home')
                            Home
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center gap-2 text-white mt-4"
                                aria-current="page">
                                @include('icons/user-group')
                                User Management
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center gap-2 text-white mt-4"
                                aria-current="page">
                                @include('icons/user')
                                Profile
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
            <div class="w-full">
                <nav class="navbar navbar-expand-md navbar-light bg-navy shadow-sm" data-bs-theme="dark">
                    <div class="container">
                        @guest
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            @endif
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown align-item-center">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <main class="py-3 container content">
                        @yield('content')
                    </main>

                    @guest
                        <div class="shadow-lg">
                            <div class="py-3 container">
                                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                                    <div class="col-md-4 d-flex align-items-center">
                                        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                                            <svg class="bi" width="30" height="24">
                                                <use xlink:href="#bootstrap"></use>
                                            </svg>
                                        </a>
                                        <span class="mb-3 mb-md-0 text-body-secondary">© 2024 Company, Inc</span>
                                    </div>

                                    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                                        <li class="ms-3"><a class="text-body-secondary" href="#">
                                                @include('icons/x')
                                            </a>
                                        </li>
                                        <li class="ms-3"><a class="text-body-secondary" href="#">
                                                @include('icons/instagram')
                                            </a>
                                        </li>
                                        <li class="ms-3"><a class="text-body-secondary" href="#">
                                                @include('icons/facebook')
                                            </a>
                                        </li>
                                    </ul>
                                </footer>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </body>

        </html>
