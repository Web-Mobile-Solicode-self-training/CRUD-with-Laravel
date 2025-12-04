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

    public function __construct()
{
    $this->middleware('auth');
}

    public function index(): View
    {
        $articles = Article::latest('id')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function create(): View
    {
        if (Gate::denies('create-article')) {
            abort(403);
        }
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        if (Gate::denies('create-article')) {
            abort(403);
        }
        $data = $request->validated();
        $data['slug'] ??= Str::slug($data['title']);
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

        if (Gate::denies('delete-article', $article)) {
            abort(403);
        }
        $article->delete();
        return redirect()->route('articles.index')
            ->with('status', '🗑️ Article supprimé.');
    }
}
