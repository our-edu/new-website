<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Galleries;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends BaseModel
{

    protected $table = 'galleries';
    public $timestamps = true;

    protected $fillable =[
        'image',

    ];
    public function getData()
    {
        return $this;
    }
}
