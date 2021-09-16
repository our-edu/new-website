<?php

namespace App\CommunicationApp\Settings\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Settings\model\GeneralSettings;

class GeneralSettingsRepository extends RepositoryAlias implements GeneralSettingsRepositoryInterface
{
    public function model(): string
    {
      return  GeneralSettings::class;
    }

    public function find($id, $columns = ['*']): GeneralSettings
    {
        return parent::find($id, $columns);
    }
    public function create(array $attributes): GeneralSettings
    {
        return parent::create($attributes);
    }
    public function update(array $attributes, $id): GeneralSettings
    {
        return  parent::update($attributes, $id);
    }
}