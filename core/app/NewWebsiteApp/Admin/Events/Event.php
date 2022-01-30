<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Events;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Meta;
use App\BaseApp\Traits\ResolveRouteBinding;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends BaseModel
{
    use Sluggable , ResolveRouteBinding;
    protected $table = 'events';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'event_img',

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
