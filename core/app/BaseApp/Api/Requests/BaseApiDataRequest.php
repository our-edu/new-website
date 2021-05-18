<?php

declare(strict_types = 1);

namespace App\OurEdu\BaseApp\Api\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiDataRequest extends BaseApiRequest
{
    public function validationData()
    {
        $data = $this->json()->all();
        if (!isset($data['data']['attributes'])) {
            throw new HttpResponseException(response()->json([
                'status' => 422,
                'title' => 'attributes not found',
                'detail' => 'attributes not found'
            ], 422));
        }
        return $data['data']['attributes'];
    }
}
