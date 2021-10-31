<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use App\CommunicationApp\Complains\Enums\ComplainCategoriesEnum;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Illuminate\Validation\Rule;

class RejectComplainRequest extends BaseApiRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {

        return [
            "status" => 'required|in:'.ComplainStatusesEnum::REJECTED_EN,
            "reason" => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'status' => trans('complains.fields.status'),
            'reason' => trans('complains.fields.reason'),
        ];
    }
}
