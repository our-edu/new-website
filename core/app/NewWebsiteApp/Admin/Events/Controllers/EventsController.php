<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Events\Controllers;

use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Articles\Requests\CreateArticleRequest;
use App\NewWebsiteApp\Admin\Articles\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\NewWebsiteApp\Admin\Books\Book;
use App\NewWebsiteApp\Admin\Books\Requests\CreateBookRequest;
use App\NewWebsiteApp\Admin\Books\Requests\UpdateBookRequest;
use App\NewWebsiteApp\Admin\Events\Event;
use App\NewWebsiteApp\Admin\Events\Requests\CreateEventRequest;
use App\NewWebsiteApp\Admin\Events\Requests\UpdateEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public $model;
    public $module;

    public function __construct(Event $model)
    {
        $this->module = 'events';
        $this->title = 'Events';
        $this->model = $model;
    }
    public function index()
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'List events';
        $data['rows'] = $this->model->getData()->latest()->paginate();
        return view('admin.'.$this->module . '.index', $data);
    }

    public function create()
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'Create' . " " . $this->title;
        $data['row'] = $this->model;
        return view('admin.'.$this->module . '.create', $data);
    }
    public function store(CreateEventRequest $request)
    {
        $data['module'] = $this->module;

        $row = new Event();
        $row->title = $request->title;
        $row->slug = \Str::slug($request->title);
        $row->description = $request->description;
        $row->event_date = $request->event_date;
        $row->start_time = $request->start_time;
        $row->end_time = $request->end_time;
        if ($request->getImageData()) {
            $row->event_img = $request->getImageData();
        }
        $row->save();
        if (!empty($request->meta)) {
            $row->meta()->create($request['meta']);
        }
        toast('???? ?????????? ???????????? ??????????', 'success');
        return redirect('/admin/' . $this->module);

//        $data['module'] = $this->module;
//        if ($row = $this->model->create($request->except('slug'))) {
//            flash()->success(trans('app.Created successfully'));
//            return redirect( '/' . $this->module );
//        }
//        flash()->error(trans('app.failed to save'));
//        return back();
    }

    public function show($id)
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'View' . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view('admin.'.$this->module . '.view', $data);
    }
    public function edit($id)
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'Edit' . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $event= $this->model->findOrFail($id);
        $data['row'] = $event ;
        $data['image'] = env('APP_URL')."/storage/photos/".$event->event_img;
        return view('admin.'.$this->module . '.edit', $data);
    }


    public function update(UpdateEventRequest $request, $id)
    {
        $data['module'] = $this->module;
        $row = $this->model->findOrFail($id);
        $row->title = $request->title;
        $row->slug = \Str::slug($request->title);
        $row->description = $request->description;
        $row->event_date = $request->event_date;
        $row->start_time = $request->start_time;
        $row->end_time = $request->end_time;
        if ($request->getImageData()) {
            $row->event_img = $request->getImageData();
        }
        $row->update();
        if (!empty($request->meta)) {
            if ($row->meta()->exists()) {
                $row->meta()->update($request['meta']);
            } else {
                $row->meta()->create($request['meta']);
            }
        }
        toast('???? ?????????? ???????????? ??????????', 'success');
        return redirect('/admin/' . $this->module);
    }



    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        toast('???? ?????? ???????????? ??????????', 'success');
        return back();
    }
}
