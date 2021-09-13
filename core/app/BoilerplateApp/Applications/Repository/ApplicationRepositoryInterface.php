<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Repository;

use App\BoilerplateApp\Applications\Models\ChildApplication;
use App\BoilerplateApp\Applications\Models\ServiceOrder;
use App\BoilerplateApp\Bills\Models\Bill;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;

interface ApplicationRepositoryInterface extends RepositoryInterface
{
    public function getFilteredApplicationsPaginate($request, $branchID) : LengthAwarePaginator;

    public function createAttachments(string $application_uuid, array $data): bool;

    public function updateAttachments(string $application_uuid, array $data): bool;

    public function createApplicationStatus(string $application_uuid, array $attributes): bool;

    public function setStatus($application_uuid, $status, $reason = null) : bool;


    public function find($id, $columns = ['*']): ChildApplication;

    public function create(array $attributes): ChildApplication;

    public function update(array $attributes, $id): ChildApplication;


    public function createApplicationBill(string $application_uuid, string $service_order_uuid, float $total) : bool;
    public function createApplicationServiceOrder(string $application_uuid, array $services, float $total_cost) : ServiceOrder;
}
