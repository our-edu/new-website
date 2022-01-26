<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Researches;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\ResolveRouteBinding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Research extends BaseModel
{
    use Sluggable , ResolveRouteBinding;
    protected $table = 'researches';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'research_content',
        'cover_image',
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
