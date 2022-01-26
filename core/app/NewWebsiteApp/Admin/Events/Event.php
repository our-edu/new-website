<?php

declare(strict_types = 1);

namespace App\NewWebsiteApp\Admin\Events;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\ResolveRouteBinding;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
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
                'source' => 'title'
            ]
        ];
    }
    public function getData()
    {
        return $this;
    }
}
