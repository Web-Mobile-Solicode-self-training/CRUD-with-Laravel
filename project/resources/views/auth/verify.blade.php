@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ __('Verify Your Email Address') }}
            </h2>
        </div>

        <!-- Body -->
        <div class="px-6 py-6">

            @if (session('resent'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-300 rounded-lg">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p class="text-gray-700 mb-4">
                {{ __('Before proceeding, please check your email for a verification link.') }}
            </p>

            <p class="text-gray-700 mb-4">
                {{ __('If you did not receive the email') }},
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button 
                    type="submit" 
                    class="text-blue-600 hover:text-blue-800 font-medium underline"
                >
                    {{ __('click here to request another') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
