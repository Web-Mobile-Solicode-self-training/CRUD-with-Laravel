@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
        
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                <input id="name" type="text"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 @error('name') border-red-500 @enderror"
                       name="name" value="{{ old('name') }}" required autofocus>

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                <input id="email" type="email"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 @error('email') border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required>

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input id="password" type="password"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 @error('password') border-red-500 @enderror"
                       name="password" required>

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label for="password-confirm" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                <input id="password-confirm" type="password"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500"
                       name="password_confirmation" required>
            </div>

            {{-- Submit button --}}
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Register
            </button>

        </form>
    </div>
</div>
@endsection
