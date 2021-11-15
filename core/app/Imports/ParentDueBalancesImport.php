<?php

declare(strict_types = 1);

namespace App\Imports;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParentDueBalancesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return ParentDueBalance
     */
    public function model(array $row)
    {
        return new ParentDueBalance([
            //
            'parent_name'=>$row['name'],
            'national_id'=>$row['national_id'],
            'balance'=>$row['balance'],
            'email'=>$row['email']
        ]);
    }
}
