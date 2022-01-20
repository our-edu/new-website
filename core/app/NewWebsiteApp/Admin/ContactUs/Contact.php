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
        'first_name',
        'last_name',
        'message',
    ];
    public function getData()
    {
        return $this;

    }

    public function getNameAttribute(): string
    {
        return "{$this->getAttributeValue('first_name')} {$this->getAttributeValue('last_name')}";
    }
}
