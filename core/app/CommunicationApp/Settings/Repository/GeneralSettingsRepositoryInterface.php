<?php

namespace App\CommunicationApp\Settings\Repository;

use App\BaseApp\Repository\BaseRepositoryInterface;
use App\CommunicationApp\Settings\model\GeneralSettings;

interface GeneralSettingsRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id, $columns = ['*']) : GeneralSettings;
    public function create(array $attributes) : GeneralSettings;
    public function update(array $attributes, $id) :GeneralSettings;
}