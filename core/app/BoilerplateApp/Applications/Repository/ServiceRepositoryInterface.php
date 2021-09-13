<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Repository;

use App\BoilerplateApp\Applications\Models\Service;
use Prettus\Repository\Contracts\RepositoryInterface;

interface ServiceRepositoryInterface extends RepositoryInterface
{

    public function find($id, $columns = ['*']): Service;

    public function getGraderServiceCost(string $service_uuid, string  $garde_uuid)  : float;
}
