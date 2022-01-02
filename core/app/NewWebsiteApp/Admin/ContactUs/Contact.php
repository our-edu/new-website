<?php

namespace App\NewWebsiteApp\Admin\ContactUs;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
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
