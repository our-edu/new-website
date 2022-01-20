<?php

namespace App\NewWebsiteApp\Admin\Books\Controllers;
use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Articles\Requests\CreateArticleRequest;
use App\NewWebsiteApp\Admin\Articles\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\NewWebsiteApp\Admin\Books\Book;
use App\NewWebsiteApp\Admin\Books\Requests\CreateBookRequest;
use App\NewWebsiteApp\Admin\Books\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class BooksController extends Controller
{
    public $model;
    public $module;

    public function __construct(Book $model)
    {
        $this->module = 'books';
        $this->title = 'Books';
        $this->model = $model;
    }
    public function index()
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'List Books';
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
    public function store(CreateBookRequest $request)
    {
        $data['module'] = $this->module;

        $row = new Book();
        $row->name = $request->name;
        $row->slug = \Str::slug($request->name);
        $row->description = $request->description;
        $row->author = $request->author;
        $row->book_img = $request->book_img;
        $row->publish_date = $request->publish_date;
        $row->is_active = $request->is_active;
        $row->is_featured = $request->is_featured;
        $row->is_recommended = $request->is_recommended;
        $row->save();
        toast('تم انشاء المقاله بنجاح', 'success');
        return redirect( '/admin/' . $this->module );

    }


    public function edit($id) {
        $data['module'] = $this->module;
        $data['page_title'] = 'Edit' . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view('admin.'.$this->module . '.edit', $data);
    }


    public function update(UpdateBookRequest $request , $id) {
        $data['module'] = $this->module;
        $row = $this->model->findOrFail($id);
        $row->name = $request->name;
        $row->description = $request->description;
        $row->author = $request->author;
        $row->publish_date = $request->publish_date;
        $row->is_active = $request->is_active;
        $row->is_featured = $request->is_featured;
        $row->is_recommended = $request->is_recommended;
        if ($request->hasFile('book_img')) {
            $row->book_img = $request->book_img;
        }
        $row->update();
        toast('تم تعديل الكتاب بنجاح', 'success');

        return redirect( '/admin/' . $this->module );
    }



    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        toast('تم حذف الكتاب بنجاح', 'success');
        return back();
    }

}
