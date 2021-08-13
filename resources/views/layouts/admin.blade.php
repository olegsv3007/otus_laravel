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
<body class="cms-body">
    <header class="cms-header">
       <div class="header-cms">
           <div class="auth-container">
               <a href="#" class="auth-container_item">{{ auth()?->user()->email ?? 'email@examle.com' }}</a>
               <a class="auth-container_item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                   {{ __('cms/common.logout') }}
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                   @csrf
               </form>
           </div>
       </div>
    </header>
    <div class="sidebar">
        <x-cms-menu.menu />
    </div>
    <div class="cms-content">
        @yield('content')
    </div>
</body>
</html>
