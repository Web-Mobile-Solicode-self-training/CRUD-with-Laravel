@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Admin Area</h1>

    @auth
        <p class="mb-2">User logged in: <span class="font-semibold">{{ Auth::user()->name }}</span></p>

        @if(Auth::user()->is_admin)
            <span class="inline-flex items-center rounded-full bg-red-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                Admin
            </span>
        @else
            <span class="inline-flex items-center rounded-full bg-sky-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                Author
            </span>
        @endif
    @endauth
</div>
@endsection
