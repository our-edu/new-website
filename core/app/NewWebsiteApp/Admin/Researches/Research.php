<?php

namespace App\NewWebsiteApp\Admin\Researches;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class Research extends BaseModel
{
    use Sluggable;
    protected $table = 'researches';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'research_content',
        'image',
        'is_featured',
        'is_active',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getData()
    {
        return $this;
    }
}