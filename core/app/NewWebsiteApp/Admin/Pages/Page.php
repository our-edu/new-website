<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Pages;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{
    protected $table = 'pages';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'body',
    ];

    public function getData()
    {
        return $this;
    }
}
