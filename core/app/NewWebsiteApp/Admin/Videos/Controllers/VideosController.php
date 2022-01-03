<?php

namespace App\NewWebsiteApp\Admin\Videos\Controllers;
use App\Http\Controllers\Controller;
use App\NewWebsiteApp\Admin\Videos\Requests\CreateVideosRequest;
use App\NewWebsiteApp\Admin\Videos\Requests\UpdateVideosRequest;
use App\NewWebsiteApp\Admin\Videos\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function Illuminate\Support\Facades\Gate;


class VideosController extends Controller
{
    public $model;
    public $module;

    public function __construct(Video $model)
    {
        $this->module = 'videos';
        $this->title = 'videos';
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
    public function store(CreateVideosRequest $request)
    {
        $data['module'] = $this->module;

        $row = new Video();
        $row->title = $request->title;
        $row->description = $request->description;
        $row->video_url = $request->video_url;
        $row->video_embed = $request->video_embed;
        $row->save();
        toast('تم انشاء الفيديو بنجاح', 'success');
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


    public function update(UpdateVideosRequest $request , $id) {
        $data['module'] = $this->module;
        $row = $this->model->findOrFail($id);
        $row->title = $request->title;
        $row->description = $request->description;
        $row->video_url = $request->video_url;
        $row->video_embed = $request->video_embed;
        $row->update();
        toast('تم تعديل الفيديو بنجاح', 'success');
        return redirect( '/admin/' . $this->module );
    }



    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        toast('تم حذف الفيديو بنجاح', 'success');
        return back();
    }

}
