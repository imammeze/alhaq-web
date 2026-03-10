<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Resources\Api\ArticleResource;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->where('is_published', true)
            ->latest()
            ->paginate(10);

        return ArticleResource::collection($articles);
    }

    public function show($slug)
    {
        $article = Article::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return new ArticleResource($article);
    }
}