<?php

namespace App\Http\Controllers;
// モデルのインポート
use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Articlesのデータを全て取得
        $articles = Article::all()->sortByDesc('created_at');
        return view('articles.index', ['articles' => $articles]);
    }
}
