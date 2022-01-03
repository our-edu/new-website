<?php

namespace App\NewWebsiteApp\Admin\Events;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends BaseModel
{

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
    public function getData()
    {
        return $this;
    }
}