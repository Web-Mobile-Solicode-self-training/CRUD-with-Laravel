@extends('layouts.app')

@section('content')
  <h1>Créer un article</h1>

<form method="POST" action="{{ route('articles.store') }}">
  @csrf

  <label for="title">Titre</label>
  <input id="title" name="title" type="text" value="{{ old('title') }}">
  @error('title')
    <div class="text-red-600 text-sm">{{ $message }}</div>
  @enderror

  <label for="slug">Slug</label>
  <input id="slug" name="slug" type="text" value="{{ old('slug') }}">
  @error('slug')
    <div class="text-red-600 text-sm">{{ $message }}</div>
  @enderror

  <label for="content">Contenu</label>
  <textarea id="content" name="content">{{ old('content') }}</textarea>
  @error('content')
    <div class="text-red-600 text-sm">{{ $message }}</div>
  @enderror

  <button type="submit">Enregistrer</button>
</form>

@endsection
