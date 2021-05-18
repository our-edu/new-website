<?php

declare(strict_types = 1);

namespace App\BaseApp\Api\Requests;

use Czim\JsonApi\Http\Requests\JsonApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiRequest extends JsonApiRequest
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
