<?php

declare(strict_types = 1);

namespace App\BaseApp\Traits;

use App\BaseApp\Models\User;
use Illuminate\Support\Facades\DB;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        static::saved(function ($model) {
            if (!$model->created_by && $model->table != null) {
                if ($user = auth()->user()) {
                    DB::table($model->table)->where('uuid', $model->uuid)->
                            update(['created_by' => (@$user->uuid)? : null]);
                }
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
