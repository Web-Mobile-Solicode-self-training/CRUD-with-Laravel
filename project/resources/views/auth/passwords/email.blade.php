@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">

    <div class="bg-white shadow-md rounded-lg p-6">

        {{-- Title --}}
        <h2 class="text-xl font-semibold mb-4">
            {{ __('Reset Password') }}
        </h2>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                {{ session('status') }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block font-medium mb-1">
                    {{ __('Email Address') }}
                </label>

                <input id="email" type="email"
                       class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button --}}
            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
