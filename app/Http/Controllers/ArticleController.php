<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Category;


class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth', only: ['create'])
        ];
    }

   public function index()
{
    $articles = Article::latest()->paginate(6);

    return view('articles.index', compact('articles'));
}

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }
    public function byCategory(Category $category)
{
    $articles = $category->articles()->latest()->get();

    return view('articles.byCategory', compact('articles', 'category'));
}
}
