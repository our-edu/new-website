<?php

declare(strict_types = 1);

namespace App\BaseApp\UseCases\CrudUseCases;

interface ListUseCaseInterface
{
    public function list();
    public function listWithFilter($filter);
}
