@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Confirm Password</h2>

        <p class="text-gray-600 text-center mb-6">
            Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input id="password" type="password"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 
                              focus:ring focus:ring-blue-200 focus:border-blue-500
                              @error('password') border-red-500 @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-between">
                
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Confirm Password
                </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-blue-600 hover:underline text-sm">
                        Forgot Your Password?
                    </a>
                @endif
            </div>

        </form>
    </div>
</div>
@endsection
