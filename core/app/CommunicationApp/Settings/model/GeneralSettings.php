<?php

namespace App\CommunicationApp\Settings\model;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralSettings extends BaseModel
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'settings';
    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value'
    ];


}