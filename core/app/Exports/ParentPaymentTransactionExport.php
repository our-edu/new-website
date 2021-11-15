<?php

namespace App\Exports;

use App\AutomaticPaymentApp\Models\ParentPaymentTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParentPaymentTransactionExport implements FromCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ParentPaymentTransaction::all();
    }
}
