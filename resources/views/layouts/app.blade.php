<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Fossil Finder') }}</title>
        <!-- Scripts -->
        
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('style-links')
        {{-- <style>
            @yield('styles')
        </style> --}}
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Fossil Finder') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @auth
                                {{-- {{ dd(auth()->user()->hasRole('adminastrator')) }} --}}
                                {{-- {{  dd($user->hasRole('superadministrator')) }} --}}
                                {{-- {{ $user ?? 'no user' }} role --}}
                                {{-- @if($user->hasRole('superadministrator')) --}}
                                {{-- {{ Auth::user()->roles }} --}}
                                @if(count(Auth::user()->roles) > 0)
                                    @if(Auth::user()->roles[0]->id == 1)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a>
                                        </li>
                                    @endif
                                    @if(Auth::user()->roles[0]->id == 2)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a>
                                        </li>
                                    @endif
                                @endif
                                {{-- @if($user->isAbleTo('users-read'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                                    </li>
                                @endif
                                @if($user->isAbleTo('posts-read'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a>
                                    </li>
                                @endif --}}
                                {{-- @endhasrole --}}
                            @endauth
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/login">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="/register">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <form method="post" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                
                {{-- @includeWhen(request()->is('/'), 'partials.map') --}}
                @yield('content')
            </main>
        </div>

        @yield('scripts')
    </body>
</html>