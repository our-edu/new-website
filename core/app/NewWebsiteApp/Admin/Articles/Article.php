<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Articles;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Meta;
use App\BaseApp\Traits\ResolveRouteBinding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
                'source' => 'title',
                'onUpdate'=>true
            ]
        ];
    }
    public function getData()
    {
        return $this;
    }


    /**
     * @return MorphOne
     */
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'metable');
    }
}
