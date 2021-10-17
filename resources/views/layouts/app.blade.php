<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/maomaochong.jpg') }}" type="image/x-icon"/>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/maomaochong.jpg') }}" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- 功能入口 -->
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else
                    <ul class="navbar-nav mr-auto   d-block d-md-none d-sm-block">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ __('User Page (AG-Grid)')  }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('allUserAG') }}">
                                    {{ __('User Management(AG-Grid)') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ __('Player Page')  }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('allPlayers') }}">
                                    {{ __('players Management') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('addPlayer') }}">
                                    {{ __('Add Player') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ __('Game Page')  }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('allGames') }}">
                                    {{ __('Games Management') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('addGame') }}">
                                    {{ __('Add Game') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ __('Bet Page')  }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('allBets') }}">
                                    {{ __('bets Management') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('barChart') }}">
                                    {{ __('Bar Chart') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ __('Daily Bets Page')  }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('allDailyBets') }}">
                                    {{ __('Daily Bet Management') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                    @endguest
                    <!-- 功能入口 -->
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        <!-- sidebars -->
<div class="container-fluid">
<div class="row">
         @guest
          @else
    <nav class="col-md-2 d-none d-md-block bg-light sidebar vh-90">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#usersManagement"  data-toggle="collapse" href="#usersManagement"
                role="button" aria-expanded="false" aria-controls="usersManagement" >
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                Users Management (AG-Grid)
                </a>
                <div class="collapse multi-collapse " id="usersManagement">
                    <a class="dropdown-item" href="{{ route('allUserAG') }}">User Management(AG-Grid)</a>
                <div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#playerManagement"  data-toggle="collapse" href="#playerManagement"
                role="button" aria-expanded="false" aria-controls="playerManagement" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Player Management 
                </a>
                <div class="collapse multi-collapse " id="playerManagement">
                    <a class="dropdown-item" href="{{ route('allPlayers') }}">Players Table</a>
                    <a class="dropdown-item" href="{{ route('addPlayer') }}">Add Player</a>
                <div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#gamesManagement"  data-toggle="collapse" href="#gamesManagement"
                role="button" aria-expanded="false" aria-controls="gamesManagement" >
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                Games Management
                </a>
                <div class="collapse multi-collapse " id="gamesManagement">
                    <a class="dropdown-item" href="{{ route('allGames') }}">Games Table</a>
                    <a class="dropdown-item" href="{{ route('addGame') }}">Add Game</a>
                <div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#betsManagement"  data-toggle="collapse" href="#betsManagement"
                role="button" aria-expanded="false" aria-controls="betsManagement" >
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                Bets Management
                </a>
                <div class="collapse multi-collapse " id="betsManagement">
                    <a class="dropdown-item" href="{{ route('allBets') }}">Bets Table</a>
                    <a class="dropdown-item" href="{{ route('barChart') }}">Bets Chart</a>
                <div>
            </li>

            
            <li class="nav-item">
                <a class="nav-link" href="#dailyBetsManagement"  data-toggle="collapse" href="#dailyBetsManagement"
                role="button" aria-expanded="false" aria-controls="dailyBetsManagement" >
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                Daily Bets Management
                </a>
                <div class="collapse multi-collapse " id="dailyBetsManagement">
                    <a class="dropdown-item" href="{{ route('allDailyBets') }}">Bet Table</a>
                <div>
            </li>
        </nav>
          @endguest
        <main class="col-md-10  py-4">
            @yield('content')
        </main>
    </div>
    </div>
     </div>
</body>
</html>
