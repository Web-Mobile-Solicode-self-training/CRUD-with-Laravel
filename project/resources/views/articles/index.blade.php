@extends('layouts.app')

@section('content')
  <h1>Articles</h1>

  @if (session('status'))
    <div style="background:#e6ffed;border:1px solid #86efac;padding:.5rem;margin-bottom:1rem;">
      {{ session('status') }}
    </div>
  @endif
  
@can('create-article')
  <a href="{{ route('articles.create') }}"
      class="inline-flex items-center rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
       Ajouter un article
   </a>
@endcan
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th style="border-bottom:1px solid #ccc;text-align:left;">Titre</th>
        <th style="border-bottom:1px solid #ccc;text-align:left;">Slug</th>
        <th style="border-bottom:1px solid #ccc;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($articles as $a)
        <tr>
          <td>{{ $a->title }}</td>
          <td>{{ $a->slug }}</td>
          <td style="text-align:center;">
            <a href="{{ route('articles.edit', $a) }}">✏️</a>
            @can('delete-article', $a)
            <form action="{{ route('articles.destroy', $a) }}" method="POST" style="display:inline;">
              @csrf 
              @method('DELETE')
              <button type="submit" onclick="return confirm('Supprimer ?')">🗑️</button>
            </form>
            @endcan

            @cannot('delete-article', $a)
                   <span class="ml-2 text-xs text-gray-500">
                       Vous ne pouvez pas supprimer cet article.
                   </span>
            @endcannot
          </td>
        </tr>
      @empty
        <tr><td colspan="3">Aucun article disponible.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top:1rem;">
    {{ $articles->links() }}
  </div>
@endsection