<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadedMedia extends BaseModel
{
    use SoftDeletes ;

    protected $fillable =[
        'source_filename',
        '',
        'size',
        'mime_type',
        'file_path',
        'url',
        'extension',
        'status'
    ];

    /**
     * @return string
     */
    public function getUrlAttribute() : string
    {
        return env('MEDIA_SERVICE_HOST')."storage/uploaded_media/". $this->getAttributeValue('filename');
    }
}
