<?php

namespace App\BaseApp\Api\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiTokenDataRequest extends BaseApiRequest
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
