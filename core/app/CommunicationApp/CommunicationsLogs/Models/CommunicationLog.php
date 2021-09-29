<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Models;

use App\BaseApp\Models\Branch;
use App\BaseApp\Models\ParentUser;
use App\BaseApp\Models\User;
use App\BaseApp\Traits\ExportTrait;
use App\CommunicationApp\CommunicationsLogs\Enums\CommunicationLogTypesEnums;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunicationLog extends \App\BaseApp\BaseModel
{

    use SoftDeletes, ExportTrait;
    protected $table = 'communications_log';
    /**
     * @var string[]
     */
    protected $fillable = [
        'type',
        'reason',
        'parent_uuid',
        'date',
        'procedure',
        'creator_uuid',
        'branch_uuid'
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ParentUser::class, 'parent_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_uuid');
    }

    /**
     * @param $data
     * @return array|null
     * @psalm-return 'array{"Added by": mixed, "taken Actions"'?: mixed, Date: mixed, Purpose: mixed}|null'
     */
    protected function exportedData($data)
    {
        if ($data->type == CommunicationLogTypesEnums::VISITS) {
            return [
                'Date' => $data->date,
                'Purpose' => $data->reason,
                'Added by' => $data->creator->name,
            ];
        }
        if ($data->type == CommunicationLogTypesEnums::CALLS) {
            return [
                'Date' => $data->date,
                'Purpose' => $data->reason,
                'taken Actions' => $data->procedure,
                'Added by' => $data->creator->name,
            ];
        }
        return null;
    }
}
