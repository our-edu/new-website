<?php

namespace App\NewWebsiteApp\Admin\Articles\Controllers;
use App\NewWebsiteApp\Admin\Articles\Article;
use App\NewWebsiteApp\Admin\Articles\Requests\CreateArticleRequest;
use App\NewWebsiteApp\Admin\Articles\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function Illuminate\Support\Facades\Gate;


class ArticlesController extends Controller
{
    public $model;
    public $module;

    public function __construct(Article $model)
    {
        $this->module = 'articles';
        $this->title = 'Articles';
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
    public function store(CreateArticleRequest $request)
    {
        $data['module'] = $this->module;

        $row = new Article();
        $row->title = $request->title;
        $row->slug = \Str::slug($request->title);
        $row->description = $request->description;
        $row->article_content = $request->article_content;
        $row->post_img = $request->post_img;
        $row->is_active = $request->is_active;
        $row->save();
        return redirect( '/admin/' . $this->module );

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

    public function edit($id) {
        $data['module'] = $this->module;
        $data['page_title'] = 'Edit' . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view('admin.'.$this->module . '.edit', $data);
    }


    public function update(UpdateArticleRequest $request , $id) {
        $data['module'] = $this->module;
        $row = $this->model->findOrFail($id);
        $row->title = $request->title;
        $row->description = $request->description;
        $row->article_content = $request->article_content;
        $row->post_img = $request->post_img;
        $row->is_active = $request->is_active;
        if ($request->hasFile('post_img')) {
            $row->post_img = $request->post_img;
        }
        $row->update();
        return redirect( '/admin/' . $this->module );
    }



    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        return back();
    }

}
