<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Gate; 

class ArticleController extends Controller
{
    // The index and view methods are public by default, no changes needed here.
    public function index(): View
    {
        $articles = Article::latest('id')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function create(): View
    {
        if (! Gate::allows('create-article')) {
            abort(403, 'Unauthorized action.');
        }
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {

        if (! Gate::allows('create-article')) {
            abort(403, 'Unauthorized action.');
        }
        
        $data = $request->validated();
        $data['slug'] ??= Str::slug($data['title']);
        $data['user_id'] = auth()->id();
        Article::create($data);

        return redirect()->route('articles.index')
            ->with('status', '✅ Article créé avec succès.');
    }

    public function edit(Article $article): View
    {

        return view('articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $article->update($data);

        return redirect()->route('articles.index')
            ->with('status', '✏️ Article mis à jour.');
    }

    public function destroy(Article $article): RedirectResponse
    {

        $this->authorize('delete', $article);

        $article->delete();
        
        return redirect()->route('articles.index')
            ->with('status', '🗑️ Article supprimé.');
    }
}