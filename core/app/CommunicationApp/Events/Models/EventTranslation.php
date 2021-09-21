<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Models;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTranslation extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'body'
    ];
}
