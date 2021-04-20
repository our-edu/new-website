<?php

declare(strict_types=1);

namespace App\BaseApp\UseCases\CrudUseCases;

interface CreateUseCaseInterface
{
    public function create($request);
}