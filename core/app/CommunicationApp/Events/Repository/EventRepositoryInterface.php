<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Repository;

use App\BaseApp\Repository\BaseRepositoryInterface;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Events\Models\Event;
use App\CommunicationApp\Questions\Models\Question;
use Illuminate\Database\Eloquent\Builder;

interface EventRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id, $columns = ['*']) : Event;

    public function filterData();

    public function export();
}
