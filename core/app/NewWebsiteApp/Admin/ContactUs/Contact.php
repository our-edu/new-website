<?php

namespace App\NewWebsiteApp\Admin\ContactUs;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Contact extends BaseModel
{
    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable =[
        'email',
        'name',
        'message',
    ];
    public function getData()
    {
        return $this;

    }
}