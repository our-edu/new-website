<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Galleries;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends BaseModel
{

    protected $table = 'galleries';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'folder_name'

    ];
    public function getData()
    {
        return $this;
    }

    public function galleryImage()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
