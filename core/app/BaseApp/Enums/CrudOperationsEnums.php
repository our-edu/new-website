<?php

declare(strict_types = 1);

namespace App\BaseApp\Enums;


class CrudOperationsEnums
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const INDEX = 'index';
    const DELETE = 'delete';
    const VIEW = 'view';


    public static function getCrudOperations(): array
    {
        return [
            self::INDEX,
            self::VIEW,
            self::CREATE,
            self::UPDATE,
            self::DELETE
        ];
    }
}
