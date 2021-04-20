<?php

namespace App\BaseApp\Traits;

use Ramsey\Uuid\Uuid;

/**
 * Trait Uuids
 *
 * @package Modules\Core\Traits
 */
trait Uuids
{
    static $uuid;

    /**
     * Boot function from laravel.
     */
    public static function bootUuids ()
    {
        static::creating(function ($model) {

            $model->uuid = Uuid::uuid4()->toString();
        });
    }

//    public function getUuidAttribute()
//    {
//        return $this->uuid;
//    }

    /**
     * @param $uuid
     *
     * @return mixed
     */
    public static function find($uuid)
    {
        return static::where('uuid', '=', $uuid)->first();
    }

    /**
     * @param $uuid
     *
     * @return mixed
     */
    public static function findOrFail($uuid)
    {
        $model = static::where('uuid', '=', $uuid)->first();

        if( is_null($model) ) {
            return abort(404);
        } else {
            return $model;
        }
    }

}