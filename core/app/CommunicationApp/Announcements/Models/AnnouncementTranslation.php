<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Models;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnouncementTranslation extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'body'
    ];
}
