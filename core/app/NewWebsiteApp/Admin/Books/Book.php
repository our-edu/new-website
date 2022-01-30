<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Books;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Meta;
use App\BaseApp\Traits\ResolveRouteBinding;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends BaseModel
{
    use Sluggable , ResolveRouteBinding;
    protected $table = 'books';
    public $timestamps = true;

    protected $fillable =[
        'name',
        'description',
        'book_img',
        'is_featured',
        'is_recommended',
        'publish_date',
        'author',
        'book_pdf'
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

    /**
     * @return MorphOne
     */
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'metable');
    }
}
