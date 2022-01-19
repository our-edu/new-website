<?php

declare(strict_types=1);

namespace App\NewWebsiteApp\Front\Controllers;

use App\BaseApp\Controllers\BaseController;
use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Books\Book;


class FrontController extends BaseController
{


    public function getIndex() {
        $data = [];
        $articles= Article::where('is_featured',true)->latest()->get();
        $books= Book::where('is_featured',true)->latest()->get();
        $importent_articles= Article::where('is_featured',true)->latest()->limit(1)->get();
        return view('Front.pages.index', compact('articles','books','importent_articles'));
    }

    public function books() {
        $data = [];
        $books= Book::where('is_active',true)->latest()->get();
        return view('Front.pages.books_page', compact('books'));
    }
    public function articles() {
        $data = [];
        $articles= Article::where('is_active',true)->latest()->get();
        return view('Front.pages.articles', compact('articles'));
    }
}
