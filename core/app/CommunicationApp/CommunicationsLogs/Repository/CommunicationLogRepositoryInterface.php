<?php

namespace App\CommunicationApp\CommunicationsLogs\Repository;

use App\BaseApp\Repository\BaseRepositoryInterface;
use App\CommunicationApp\CommunicationsLogs\Models\CommunicationLog;

interface CommunicationLogRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id, $columns = ['*']) : CommunicationLog;
    public function create(array $attributes) : CommunicationLog;
    public function update(array $attributes, $id) : CommunicationLog;
}