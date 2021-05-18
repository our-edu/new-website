<?php

declare(strict_types = 1);

namespace App\BaseApp\UseCases\CrudUseCases;

class ListUseCase implements ListUseCaseInterface
{
    protected $repository;

    public function list()
    {
        return $this->repository->paginate();
    }

    public function listWithFilter($filter)
    {
        return $this->repository->paginateWithFilter($filter);
    }
}
