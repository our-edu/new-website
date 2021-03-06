<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Front\Controllers;

use App\BaseApp\Controllers\BaseController;
use App\BaseApp\Models\User;
use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Books\Book;
use App\NewWebsiteApp\Admin\ContactUs\Contact;
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
        $page = Page::whereSlug('home')->first();
        $importent_articles= Article::where('is_featured', true)->latest()->limit(1)->get();
        $articles= Article::where('is_featured', true)->latest()->skip(1)->get()->take(9);
        $books= Book::where('is_featured', true)->latest()->get();

        return view('Front.pages.index', compact('articles', 'page', 'books', 'importent_articles'));
    }

    public function books()
    {
        $data = [];
        $page = Page::whereSlug('books')->first();
        $books= Book::where('is_active', true)->where('is_recommended', false)->latest()->get();
        $recommended_books= Book::where('is_active', true)->where('is_recommended', true)->get();
        return view('Front.pages.books_page', compact('books', 'page', 'recommended_books'));
    }
    public function articles()
    {
        $data = [];
        $page = Page::whereSlug('articles')->first();
        $articles= Article::where('is_active', true)->orderByDesc('created_at')->get();
        return view('Front.pages.articles', compact('articles', 'page'));
    }
    public function researches()
    {
        $data = [];
        $page = Page::whereSlug('researches')->first();
        $articles= Research::where('is_active', true)->orderByDesc('created_at')->get();
        return view('Front.pages.researches', compact('articles', 'page'));
    }
    public function articleDetails(Article $article)
    {
        visits($article)->increment(1, true);
        $article->image = env('APP_URL')."/storage/photos/".$article->post_img;
        $article->visits =  visits($article)->count();
        return view('Front.pages.articleDetails', compact('article'));
    }
    public function researchesDetails(Research $research)
    {
        visits($research)->increment(1, true);
        $research->image = env('APP_URL')."/storage/photos/".$research->cover_image;
        $research->visits =  visits($research)->count();
        $article = $research;
        return view('Front.pages.researchesDetails', compact('article'));
    }
    public function eventDetails(Event $event)
    {
        visits($event)->increment(1, true);
        $event->image = env('APP_URL')."/storage/photos/".$event->event_img;
        $event->visits =  visits($event)->count();
        return view('Front.pages.eventDetails', compact('event'));
    }
    public function activities()
    {
        $page = Page::whereSlug('activities')->first();
        $events= Event::get();
        $last_event= Event::latest()->limit(1)->get();
        return view('Front.pages.activities', compact('events', 'page', 'last_event'));
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
        $page = Page::whereSlug('gallery')->first();
        $galleries = Gallery::orderByDesc("created_at")->get();
        foreach ($galleries as $gallery) {
            $images = Storage::files($gallery->folder_name);
            $imagesNames = [];
            foreach ($images as $image) {
                $imagesNames[] = Str::replace('public', 'storage', $image);
            }

            $gallery->images = $imagesNames;
        }
        return view('Front.pages.images', compact('galleries', 'page'));
    }
    public function videos()
    {
        $data = [];
        $videos= Video::get();
        return view('Front.pages.videos', compact('videos'));
    }

    public function contactStore(Request $request)
    {
        Contact::create($request->all());
        toast('???? ??????????????', 'success');
        return redirect()->route('contact_us');
    }
}
