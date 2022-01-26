<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Pages\Controllers;

use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Articles\Requests\CreateArticleRequest;
use App\NewWebsiteApp\Admin\Articles\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\NewWebsiteApp\Admin\Pages\Page;
use App\NewWebsiteApp\Admin\Pages\Requests\PagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PagesController extends Controller
{
    public $model;
    public $module;

    public function __construct(Page $model)
    {
        $this->module = 'pages';
        $this->title = 'pages';
        $this->model = $model;
    }
    public function index()
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'List Pages';
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
    public function store(PagesRequest $request)
    {
        $data['module'] = $this->module;

        $row = new Page();
        $row->title = $request->title;
        $row->description = $request->description;
        $row->body = $request->body;
        toast('تم الانشاء بنجاح', 'success');
        $row->save();
        return redirect('/admin/' . $this->module);
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
        $data['row'] = $this->model->findOrFail($id);
        return view('admin.'.$this->module . '.edit', $data);
    }


    public function update(PagesRequest $request, $id)
    {
        $data['module'] = $this->module;
        $row = $this->model->findOrFail($id);
        $row->title = $request->title;
        $row->description = $request->description;
        $row->body = $request->body;
        $row->update();
        toast('تم التعديل  بنجاح', 'success');

        return redirect('/admin/' . $this->module);
    }



    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        toast('تم الحذف بنجاح', 'success');
        return back();
    }
}
