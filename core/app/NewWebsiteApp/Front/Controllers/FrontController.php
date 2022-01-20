<?php

declare(strict_types=1);

namespace App\NewWebsiteApp\Front\Controllers;

use App\BaseApp\Controllers\BaseController;
use App\BaseApp\Models\User;
use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Books\Book;
use App\NewWebsiteApp\Admin\Events\Event;


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
        $recommended_books= Book::where('is_recommended',true)->get();
        return view('Front.pages.books_page', compact('books','recommended_books'));
    }
    public function articles() {
        $data = [];
        $articles= Article::where('is_active',true)->latest()->get();
        return view('Front.pages.articles', compact('articles'));
    }
    public function articleDetails($uuid) {
        $data = [];
        $article= Article::findOrFail($uuid);
        return view('Front.pages.articleDetails', compact('article'));
    }
    public function activities() {
        $data = [];
        $events= Event::get();
        $last_event= Event::latest()->limit(1)->get();

        return view('Front.pages.activities', compact('events','last_event'));
    }
    public function profile()
    {
        $data = [];
//        $profile= User::where('is_active',true)->latest()->get();
        return view('Front.pages.profile');
    }
    public function contact()
    {
        $data = [];
//        $profile= User::where('is_active',true)->latest()->get();
        return view('Front.pages.contact_us');
    }
    public function gallery()
    {
        $data = [];
//        $profile= User::where('is_active',true)->latest()->get();
        return view('Front.pages.images');
    }
    public function videos()
    {
        $data = [];
//        $profile= User::where('is_active',true)->latest()->get();
        return view('Front.pages.videos');
    }
}
