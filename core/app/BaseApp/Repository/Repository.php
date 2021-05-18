<?php

declare(strict_types = 1);

namespace App\BaseApp\Repository;

use App\BaseApp\Helpers\Filter;
use Prettus\Repository\Eloquent\BaseRepository;

class Repository extends BaseRepository implements BaseRepositoryInterface
{
    public function model(): string
    {
        return "";
    }
}
