<?php

declare(strict_types = 1);

namespace App\BaseApp\UseCases\CrudUseCases;

class ViewUseCase implements ViewUseCaseInterface
{
    protected $repository;

    public function view($id)
    {
        return $this->repository->find($id);
    }
}
