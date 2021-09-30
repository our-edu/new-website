<?php

declare(strict_types = 1);

namespace App\BaseApp\Traits;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

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
     * @param $data
     * @param string $postfixName
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function export($data, string $postfixName = '')
    {
        $filename = Carbon::now()->timestamp . '-' . Factory::create()->numberBetween(0, 9) . ($postfixName != '' ? '-' . $postfixName : '') . ".xlsx";
        $this->getCollection($data)->storeExcel(
            $filename,
            'public',
            $writerType = null,
            $headings = true
        );
        return response([
            'meta' => [
                'excel_url' => env("APP_URL") . '/storage/' . $filename,
            ]
        ]);
    }
}
