<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\UploadedMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationAttachment extends BaseModel
{
    protected $fillable = [
        'application_uuid',
        'uploaded_media_uuid'
    ];

    public function uploadedFile(): BelongsTo
    {
        return $this->belongsTo(UploadedMedia::class, 'uploaded_media_uuid');
    }
}
