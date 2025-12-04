@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    <div class="bg-white shadow-md rounded-xl border border-gray-200">
        
        {{-- Card Header --}}
        <div class="px-6 py-4 border-b border-gray-200 text-lg font-semibold">
            {{ __('Dashboard') }}
        </div>

        {{-- Card Body --}}
        <div class="p-6">
            
            @if (session('status'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-gray-700 text-base">
                {{ __('You are logged in!') }}
            </p>
        </div>
    </div>

</div>
@endsection
