<?php

declare(strict_types = 1);

namespace App\BaseApp\UseCases\CrudUseCases;

interface UpdateUseCaseInterface
{
    public function update($request, $id);
}
