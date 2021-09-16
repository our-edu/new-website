<?php

declare(strict_types = 1);
namespace App\CommunicationApp\Complains\Repository;

use App\BaseApp\Repository\BaseRepositoryInterface;
use App\CommunicationApp\Complains\Models\Complain;

interface ComplainRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id, $columns = ['*']) : Complain;
    public function create(array $attributes): Complain;
    public function update(array $attributes, $id) : Complain;
}
