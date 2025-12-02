@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Admin Area</h1>

    @auth
        <p>User logged in: {{ Auth::user()->name }}</p>

        @if(Auth::user()->is_admin)
            <p class="text-sm text-emerald-700 font-medium">
                Profile detected: <span class="font-semibold">Admin</span>
            </p>
        @else
            <p class="text-sm text-sky-700 font-medium">
                Profile detected: <span class="font-semibold">Author</span>
            </p>
        @endif
    @endauth
</div>
@endsection
