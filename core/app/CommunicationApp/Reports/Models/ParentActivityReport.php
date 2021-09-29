<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Reports\Models;

use App\BaseApp\Models\ParentUser;
use App\BaseApp\Traits\ExportTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParentActivityReport extends Model
{
    use ExportTrait;
    protected $table = 'parent_activity_report';
    /**
     * @return BelongsTo
     */
    public function parent() : BelongsTo
    {
        return $this->belongsTo(ParentUser::class, 'parent_uuid');
    }

    /**
     * @param $data
     * @return array
     */
    protected function exportedData($data): array
    {
        return [
            'parent' => $data->parent->user->name,
            'complains_count' => $data->complains_count ,
            'visits_count' => $data->visits_count ,
            'calls_count' => $data->calls_count ,
        ];
    }
}
