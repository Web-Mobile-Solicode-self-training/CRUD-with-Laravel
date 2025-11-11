<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;

class ArticleController extends Controller
{
    public function create()
    {
        // Display the form view
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        // Validation is already done in StoreArticleRequest
        // $request->validated() contains the validated data
        $validated = $request->validated();

        return back()
            ->withInput()
            ->with('status', 'Formulaire reçu avec succès ! (La sauvegarde sera ajoutée au chapitre 3.1.5)');
    }
}
