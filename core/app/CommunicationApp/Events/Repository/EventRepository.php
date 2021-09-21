<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Events\Models\Event;

class EventRepository extends RepositoryAlias implements EventRepositoryInterface
{
    public function model(): string
    {
        return Event::class;
    }

    public function find($id, $columns = ['*']): Event
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

    /**
     * @return mixed
     */
    public function export()
    {
        $data = $this->filterData()->get();
        return app($this->model())->export($data, 'events');
    }
}
