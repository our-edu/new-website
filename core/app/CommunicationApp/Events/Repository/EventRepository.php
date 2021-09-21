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

    public function filterData()
    {
        $query = $this;
        switch (request()->get('period')) {
            case 'week':
                $query = $query->whereBetween('start', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'day':
                $query = $query->whereDay('start', Carbon::now()->day);
                break;
            default:
                $query = $query->whereMonth('start', Carbon::now()->month);
                break;
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
