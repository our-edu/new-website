<?php

namespace App\BaseApp\UseCases\CrudUseCases;

class ViewUseCase implements ViewUseCaseInterface
{
    protected $repository;

    public function view($id)
    {
        return $this->repository->find($id);
    }
}