<?php

declare(strict_types = 1);

namespace App\BaseApp\Api\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;

class BaseApiTokenRequest extends BaseApiRequest
{
    public function rules()
    {
        return [];
    }
}
