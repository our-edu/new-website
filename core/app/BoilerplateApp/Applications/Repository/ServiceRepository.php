<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Repository;

use App\BaseApp\Enums\ApplicationStatusEnums;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use App\BoilerplateApp\Applications\Models\Service;
use App\BoilerplateApp\Bills\Models\Bill;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Service::class;
    }

    /**
     * @param $id
     * @param array|string[] $columns
     * @return Service
     */
    public function find($id, $columns = ['*']): Service
    {
        return parent::find($id, $columns);
    }


    public function getGraderServiceCost(string $service_uuid, string $garde_uuid): float
    {
        return  (float) $this->find($service_uuid)->grades()->find($garde_uuid)->pivot->cost;
    }
}
