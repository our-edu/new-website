<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Questions\Models\Question;
use Illuminate\Database\Eloquent\Builder;

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
    public function filterData()
    {
        $query = $this;
        if (request()->has('branch') && !empty(request()->get('branch'))) {
            $query = $query->whereHas('branches', function ($q) {
                $q->where('uuid', request()->get('branch'));
            });
        }
        if (request()->has('publisher') && !empty(request()->get('publisher'))) {
            $query = $query->where('publisher_uuid', request()->get('publisher'));
        }
        return $query;
    }
}
