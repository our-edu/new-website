<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Questions\Models\Question;

class AnnouncementRepository extends RepositoryAlias implements AnnouncementRepositoryInterface
{
    public function model(): string
    {
        return Announcement::class;
    }

    public function find($id, $columns = ['*']): Announcement
    {
        return parent::find($id, $columns);
    }
}
