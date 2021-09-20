<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Repository;

use App\BaseApp\Repository\BaseRepositoryInterface;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Questions\Models\Question;
use Illuminate\Database\Eloquent\Builder;

interface AnnouncementRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id, $columns = ['*']) : Announcement;

    public function filterData();

    public function export();
}
