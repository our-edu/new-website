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
            trans('export.reports.parent_name')  => $data->parent->user->name,
           trans('export.reports.parent_national_id')  => $data->parent->user->national_id,
           trans('export.reports.complains_count')  => $data->complains_count ,
           trans('export.reports.visits_count')  => $data->visits_count ,
            trans('export.reports.calls_count') => $data->calls_count ,
        ];
    }
}
