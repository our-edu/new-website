<?php

namespace App\Exports;

use App\AutomaticPaymentApp\Models\ParentPaymentTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParentPaymentTransactionExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ParentPaymentTransaction::select([
            'parent_name',
            'national_id',
            'balance',
            'email',
            'paid_amount'
        ])->where('paid', 1)->get();
    }

    public function headings(): array
    {
        return  [
            'Name',
            'National id',
            'Balance',
            'Email',
            'Paid_amount'

        ];

    }
}
