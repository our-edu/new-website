<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\CommunicationsLogs\Models\CommunicationLog;
use Prettus\Validator\Exceptions\ValidatorException;

class CommunicationLogRepository extends RepositoryAlias implements CommunicationLogRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return CommunicationLog::class;
    }

    /**
     * @param $id
     * @param array|string[] $columns
     * @return CommunicationLog
     */
    public function find($id, $columns = ['*']): CommunicationLog
    {
        return parent::find($id, $columns);
    }

    /**
     * @param array $attributes
     * @return CommunicationLog
     * @throws ValidatorException
     */
    public function create(array $attributes): CommunicationLog
    {
        return parent::create($attributes);
    }

    /**
     * @param array $attributes
     * @param $id
     * @return CommunicationLog
     * @throws ValidatorException
     */
    public function update(array $attributes, $id): CommunicationLog
    {
        return  parent::update($attributes, $id);
    }
}
