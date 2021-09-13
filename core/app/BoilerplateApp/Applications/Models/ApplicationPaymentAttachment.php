<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationPaymentAttachment extends BaseModel
{
    use  Uuids,SoftDeletes;

    protected $table = 'application_payment_attachments';

    protected $fillable = [
        'application_uuid',
        'uploaded_media_uuid',

    ];
}
