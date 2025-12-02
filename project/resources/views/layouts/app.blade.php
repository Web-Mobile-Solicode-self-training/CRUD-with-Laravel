<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for dropdowns -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div id="app">

        <!-- NAVBAR -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <!-- Left side -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800">
                            {{ config('app.name', 'Blog') }}
                        </a>
                    </div>

                    <!-- Right side -->
                    <div class="flex items-center" x-data="{ open: false }">

                        @guest
                            <!-- Guest Links -->
                            <div class="hidden md:flex space-x-4">
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
                            </div>
                        @else
                            <!-- Authenticated Desktop -->
                            <div class="hidden md:flex items-center relative" x-data="{ dropdown: false }">
                                <button @click="dropdown = !dropdown"
                                        class="text-gray-700 hover:text-blue-600 font-medium">
                                    {{ Auth::user()->name }}
                                </button>

                                <!-- Role Badge -->
                                @if (Auth::user()->is_admin)
                                    <span class="ml-2 inline-flex items-center rounded-full bg-red-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                        Admin
                                    </span>
                                @else
                                    <span class="ml-2 inline-flex items-center rounded-full bg-sky-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                        Author
                                    </span>
                                @endif

                                <!-- Dropdown Menu -->
                                <div x-show="dropdown"
                                     @click.away="dropdown = false"
                                     class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg py-2 z-50">

                                    <a href="{{ route('admin.dashboard') }}"
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        Admin Panel
                                    </a>

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest

                        <!-- Mobile Hamburger -->
                        <button @click="open = !open"
                                class="md:hidden text-gray-700 hover:text-blue-600 focus:outline-none ml-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <!-- Mobile Menu -->
                        <div x-show="open" class="absolute top-16 right-4 bg-white shadow-lg rounded-lg w-48 py-2 md:hidden">
                            @guest
                                @if (Route::has('login'))
                                <a href="{{ route('login') }}"
                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    {{ __('Login') }}
                                </a>
                                @endif
                                @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    {{ __('Register') }}
                                </a>
                                @endif
                            @else
                                <div class="block px-4 py-2">
                                    <span class="block font-medium">{{ Auth::user()->name }}</span>
                                    @if(Auth::user()->is_admin)
                                        <span class="inline-flex items-center rounded-full bg-red-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-sky-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                            Author
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('admin.dashboard') }}"
                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Admin Panel
                                </a>

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            @endguest
                        </div>

                    </div>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="py-6">
            @yield('content')
        </main>

    </div>
</body>
</html>
