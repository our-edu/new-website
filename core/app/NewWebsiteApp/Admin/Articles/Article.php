<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Articles;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\ResolveRouteBinding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends BaseModel
{
    use Sluggable , ResolveRouteBinding;
    protected $table = 'articles';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'article_content',
        'post_img',
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
