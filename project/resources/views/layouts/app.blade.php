<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div id="app">

        {{-- Navbar --}}
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    
                    {{-- Left side --}}
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    {{-- Right side --}}
                    <div class="flex items-center space-x-4">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">
                                    {{ __('Login') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">
                                    {{ __('Register') }}
                                </a>
                            @endif
                        @else
                        @auth
                            <div class="flex items-center space-x-4">
                             

                                <div class="flex items-center space-x-3">
                                    <span class="text-sm text-gray-700">
                                        Bonjour, {{ Auth::user()->name }}
                                    </span>

                                    @if (Auth::user()->is_admin)
                                        <span class="inline-flex items-center rounded-full bg-red-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-sky-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                            Auteur
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endauth

                            <div class="relative inline-block text-left">
                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                                        id="menu-button" aria-expanded="true" aria-haspopup="true" onclick="document.getElementById('dropdown-menu').classList.toggle('hidden')">
                                    {{ Auth::user()->name }}
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                {{-- Dropdown --}}
                                <div id="dropdown-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                    <div class="py-1">
                                        <a href="{{ route('logout') }}"
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                </div>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </div>

                </div>
            </div>
        </nav>

        {{-- Content --}}
        <main class="py-10 w-full ">
            @yield('content')
        </main>
    </div>
</body>
</html>
