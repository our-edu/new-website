<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Front\Controllers;

use App\BaseApp\Controllers\BaseController;
use App\BaseApp\Models\User;
use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Books\Book;
use App\NewWebsiteApp\Admin\Events\Event;
use App\NewWebsiteApp\Admin\Galleries\Gallery;
use App\NewWebsiteApp\Admin\Galleries\GalleryImage;
use App\NewWebsiteApp\Admin\Pages\Page;
use App\NewWebsiteApp\Admin\Researches\Research;
use App\NewWebsiteApp\Admin\Videos\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FrontController extends BaseController
{


    public function getIndex()
    {
        $data = [];
        $importent_articles= Article::where('is_featured', true)->latest()->limit(1)->get();
        $articles= Article::where('is_featured', true)->latest()->skip(1)->get()->take(9);
        $books= Book::where('is_featured', true)->latest()->get();

        return view('Front.pages.index', compact('articles', 'books', 'importent_articles'));
    }

    public function books()
    {
        $data = [];
        $page = Page::whereSlug('books')->first();
        $books= Book::where('is_active', true)->latest()->get();
        $recommended_books= Book::where('is_recommended', true)->get();
        return view('Front.pages.books_page', compact('books', 'page', 'recommended_books'));
    }
    public function articles()
    {
        $data = [];
        $articles= Article::where('is_active', true)->orderByDesc('created_at')->get();
        return view('Front.pages.articles', compact('articles'));
    }
    public function researches()
    {
        $data = [];
        $articles= Research::where('is_active', true)->orderByDesc('created_at')->get();
        return view('Front.pages.researches', compact('articles'));
    }
    public function articleDetails(Article $article)
    {
        visits($article)->increment();
        $article->image = env('APP_URL')."/storage/photos/".$article->post_img;
        $article->visits =  visits($article)->count();
        return view('Front.pages.articleDetails', compact('article'));
    }
    public function researchesDetails(Research $research)
    {
        visits($research)->increment();
        $research->image = env('APP_URL')."/storage/photos/".$research->cover_image;
        $research->visits =  visits($research)->count();
        $article = $research;
        return view('Front.pages.researchesDetails', compact('article'));
    }
    public function eventDetails(Event $event)
    {
        visits($event)->increment();
        $event->image = env('APP_URL')."/storage/photos/".$event->event_img;
        $event->visits =  visits($event)->count();
        return view('Front.pages.eventDetails', compact('event'));
    }
    public function activities()
    {
        $data = [];
        $events= Event::get();
        $last_event= Event::latest()->limit(1)->get();

        return view('Front.pages.activities', compact('events', 'last_event'));
    }
    public function profile()
    {
        $data = [];
        $profile = Page::all()->first();
        return view('Front.pages.profile', compact('profile'));
    }
    public function contact()
    {
        $data = [];
        return view('Front.pages.contact_us');
    }
    public function gallery()
    {
        $data = [];
        $galleries = Gallery::orderByDesc("created_at")->get();
        foreach ($galleries as $gallery) {
            $images = Storage::files($gallery->folder_name);
            $imagesNames = [];
            foreach ($images as $image) {
                $imagesNames[] = Str::replace('public', 'storage', $image);
            }


            $gallery->images = $imagesNames;
        }
        return view('Front.pages.images', compact('galleries'));
    }
    public function videos()
    {
        $data = [];
        $videos= Video::get();
        return view('Front.pages.videos', compact('videos'));
    }

    public function contactStore(Request $request)
    {
        $this->model->create($request->all());
        toast('تم الارسال', 'success');
        return route('contact_us');
    }
}
