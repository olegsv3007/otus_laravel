<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('public/common.company_name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="header">
                <a href="{{ route('home') }}" class="logo">{{ __('public/common.company_name') }}</a>
                <div class="auth_panel">
                    @guest
                    <a class="auth_panel_item" href="{{ route('login') }}">{{ __('public/common.auth.login') }}</a>
                    <a class="auth_panel_item" href="{{ route('register') }}">{{ __('public/common.auth.register') }}</a>
                    @else
                    <a class="auth_panel_item" href="{{ route('profile') }}">{{ auth()->user()->name }}</a>
                    <a class="auth_panel_item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('public/common.auth.logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endguest
                </div>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="footer">
                <div class="copyright">
                    &copy; 2021
                </div>
            </div>
        </footer>
    </body>
</html>
