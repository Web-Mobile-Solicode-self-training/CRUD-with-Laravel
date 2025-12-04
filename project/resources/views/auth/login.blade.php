@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8 px-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6">
        
        <h2 class="text-2xl font-semibold text-center mb-6">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">
                    {{ __('Email Address') }}
                </label>

                <input id="email" type="email"
                    class="w-full px-4 py-2 rounded-lg border @error('email') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">
                    {{ __('Password') }}
                </label>

                <input id="password" type="password"
                    class="w-full px-4 py-2 rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center mb-4">
                <input type="checkbox" name="remember" id="remember"
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    {{ old('remember') ? 'checked' : '' }}>

                <label for="remember" class="ml-2 text-gray-700 text-sm">
                    {{ __('Remember Me') }}
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col space-y-3">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg transition">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-center text-indigo-600 text-sm hover:underline">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>

        </form>
    </div>
</div>
@endsection
