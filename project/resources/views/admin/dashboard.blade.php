@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold mb-4">Espace d’administration</h1>

        @auth
            <p class="mb-2">Utilisateur connecté : {{ Auth::user()->name }}</p>

            @if (Auth::user()->is_admin)
                <p class="text-sm text-emerald-700 font-medium">
                    Profil détecté : <span class="font-semibold">Admin</span>
                </p>
            @else
                <p class="text-sm text-sky-700 font-medium">
                    Profil détecté : <span class="font-semibold">Auteur</span>
                </p>
            @endif
        @endauth
    </div>
@endsection
