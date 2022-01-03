<?php

namespace App\NewWebsiteApp\Admin\ContactUs\Controllers;

use App\Http\Controllers\Controller;
use App\NewWebsiteApp\Admin\ContactUs\Contact;
use Illuminate\Http\Request;


class ContactUsController extends Controller
{

    public $model;
    public $module;

    public function __construct(Contact $model)
    {
        $this->module = 'contact_us';
        $this->title = 'اتصل بنا';
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['module'] = $this->module;

        $data['page_title'] = trans('app.contact_us');
        $data['rows'] = $this->model->latest()->paginate(12);
        return view('admin.'.$this->module . '.index', $data);
    }

    public function show($id)
    {
        $data['module'] = $this->module;
        $data['page_title'] = 'View' . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view('admin.'.$this->module . '.view', $data);
    }

    public function destroy($id)
    {
        $row = $this->model->findOrFail($id);
        $row->delete();
        toast('تم الحذف بنجاح', 'success');
        return back();
    }
}
