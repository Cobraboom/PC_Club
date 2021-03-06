<?php
    if (\Illuminate\Support\Facades\Auth::check()){
        $user_id = Auth::user()->id;
        $is_admin = Auth::user()->is_admin;
    }
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('PC_Club_Name', 'PC_Club') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    PC_Club
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="#"> О Нас</a>
                            </li>
                            <li>
                                <a class="nav-link" href="#">Помощь</a>
                            </li>

                        @else
                            @if($is_admin == false)
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> О Нас</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="#">Поиощь</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('PC_Club.users.Ses.index') }}">Журнал Сессий</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('PC_Club.users.Ses.create') }}">Бронирование</a>
                                </li>

                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> О Нас</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="#">Помощь</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('PC_Club.admin.Ses.index') }}">Журнал Сессий</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('PC_Club.admin.PC.index') }}">Журнал PC</a>
                                </li>
                            @endif
                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->login }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
