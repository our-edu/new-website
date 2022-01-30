<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Pages;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Meta;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{
    use Sluggable ;
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
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=>false
            ]
        ];
    }

    /**
     * @return MorphOne
     */
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'metable');
    }
}
