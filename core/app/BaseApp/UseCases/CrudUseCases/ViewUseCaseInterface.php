<?php

declare(strict_types=1);

namespace App\BaseApp\UseCases\CrudUseCases;

interface ViewUseCaseInterface
{
    public function view($id);
}