<?php

namespace App\CommunicationApp\Settings\model;

use App\BaseApp\BaseModel;

class GeneralSettings extends BaseModel
{
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