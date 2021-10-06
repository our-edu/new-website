<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Repository;

use App\BaseApp\Repository\Repository as RepositoryAlias;
use App\CommunicationApp\Announcements\Models\Announcement;
use App\CommunicationApp\Events\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function filterData($start,$end)
    {
        $query = $this->where('start',">=",$start)->where('end',"<=",$end);
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
