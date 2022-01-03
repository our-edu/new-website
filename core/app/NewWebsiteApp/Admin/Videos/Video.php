<?php

namespace App\NewWebsiteApp\Admin\Videos;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends BaseModel
{

    protected $table = 'videos';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'video_url',
        'video_embed',
    ];
    public function getData()
    {
        return $this;
    }
}