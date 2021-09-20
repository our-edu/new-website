<?php

declare(strict_types = 1);

namespace App\BaseApp\Traits;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Collection;

trait ExportTrait
{
    /**
     * @param $data
     * @return Collection
     */
    private function getCollection($data) : Collection
    {
        $collection = [];
        foreach ($data as $item) {
            $collection[] = $this->exportedData($item);
        }
        return collect($collection);
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function exportedData($data)
    {
        return $data;
    }

    /**
     * @return mixed
     */
    public function export($data, $postfixName = '')
    {
        return $this->getCollection($data)->downloadExcel(
            Carbon::now()->timestamp . '-' . Factory::create()->numberBetween(0, 9) . ($postfixName != '' ? '-' . $postfixName : '') . ".xlsx",
            $writerType = null,
            $headings = true
        );
    }
}
