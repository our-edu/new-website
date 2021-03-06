<?php

declare(strict_types = 1);

namespace App\BaseApp\UseCases\CrudUseCases;

interface DeleteUseCaseInterface
{
    public function delete($id);
}
