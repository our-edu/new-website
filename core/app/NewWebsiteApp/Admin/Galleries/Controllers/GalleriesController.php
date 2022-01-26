<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Galleries\Controllers;

use App\Http\Controllers\Controller;
use App\NewWebsiteApp\Admin\Galleries\Gallery;
use App\NewWebsiteApp\Admin\Galleries\Requests\CreateGalleryRequest;
use App\NewWebsiteApp\Admin\Galleries\Requests\UpdateGalleryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GalleriesController extends Controller
{
    public $model;
    public $module;

    public function __construct(Gallery $model)
    {
        $this->module = 'galleries';
        $this->title = 'galleries';
        $this->model = $model;
    }
    public function index()
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'List Articles';
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
    public function store(CreateGalleryRequest $request)
    {
        $data['module'] = $this->module;

        $row = new Gallery();
        $row->title = $request->title;
        $row->slug = \Str::slug($request->title);
        $row->description = $request->description;
        $row->galleryImage->image = $request->galleryImage->image;
        $row->save();
        toast('تم انشاء الصوره بنجاح', 'success');
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


    public function update(UpdateGalleryRequest $request, $id)
    {
        $data['module'] = $this->module;
        $row = $this->model->findOrFail($id);
        $row->title = $request->title;
        $row->slug = \Str::slug($request->title);
        $row->description = $request->description;
        if ($request->hasFile('image')) {
            $row->galleryImage->image = $request->galleryImage->image;
        }
        $row->update();
        toast('تم تعديل الصوره بنجاح', 'success');
        return redirect('/admin/' . $this->module);
    }



    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        toast('تم حذف الصوره بنجاح', 'success');
        return back();
    }
}
