<?php

namespace App\NewWebsiteApp\Admin\Researches\Controllers;
use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Articles\Requests\CreateArticleRequest;
use App\NewWebsiteApp\Admin\Articles\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\NewWebsiteApp\Admin\Researches\Requests\ResearchRequest;
use App\NewWebsiteApp\Admin\Researches\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class ResearchesController extends Controller
{
    public $model;
    public $module;

    public function __construct(Research $model)
    {
        $this->module = 'researches';
        $this->title = 'Researches';
        $this->model = $model;
    }
    public function index()
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'List Researches';
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
    public function store(ResearchRequest $request)
    {
        $data['module'] = $this->module;

        $row = new Research();
        $row->title = $request->title;
        $row->slug = \Str::slug($request->title);
        $row->description = $request->description;
        $row->research_content = $request->research_content;
        $row->image = $request->image;
        $row->is_featured = $request->is_featured;
        $row->is_active = $request->is_active;
        toast('تم انشاء البحث بنجاح', 'success');
        $row->save();
        return redirect( '/admin/' . $this->module );

    }


    public function show($id)
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'View' . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view('admin.'.$this->module . '.view', $data);
    }

    public function edit($id) {
        $data['module'] = $this->module;
        $data['page_title'] = 'Edit' . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view('admin.'.$this->module . '.edit', $data);
    }


    public function update(ResearchRequest $request , $id) {
        $data['module'] = $this->module;
        $row = $this->model->findOrFail($id);
        $row->title = $request->title;
        $row->description = $request->description;
        $row->research_content = $request->research_content;
        $row->image = $request->image;
        $row->is_featured = $request->is_featured;
        $row->is_active = $request->is_active;
        if ($request->hasFile('image')) {
            $row->image = $request->image;
        }
        $row->update();
        toast('تم تعديل البحث بنجاح', 'success');

        return redirect( '/admin/' . $this->module );
    }



    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        toast('تم حذف البحث بنجاح', 'success');
        return back();
    }

}
