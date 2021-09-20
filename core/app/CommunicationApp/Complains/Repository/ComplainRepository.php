<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Complains\Models\Complain;

class ComplainRepository extends RepositoryAlias implements ComplainRepositoryInterface
{
    public function model(): string
    {
        return Complain::class;
    }

    public function find($id, $columns = ['*']): Complain
    {
        return parent::find($id, $columns);
    }
    public function create(array $attributes): Complain
    {
        return parent::create($attributes);
    }
    public function update(array $attributes, $id): Complain
    {
        return  parent::update($attributes, $id);
    }
}
