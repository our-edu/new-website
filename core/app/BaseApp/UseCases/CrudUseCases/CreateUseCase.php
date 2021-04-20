<?php

namespace App\BaseApp\UseCases\CrudUseCases;

class CreateUseCase implements CreateUseCaseInterface
{
    protected $repository;

    public function create($request)
    {
        return $this->repository->create($request->data['attributes']);
    }
}