<?php

declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Admin\Controllers;

use App\AutomaticPaymentApp\Repository\ParentDueBalanceRepositoryInterface;
use App\AutomaticPaymentApp\Repository\ParentPaymentTransactionRepositoryInterface;
use App\BaseApp\Controllers\BaseController;
use App\Imports\ParentDueBalancesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use MongoDB\Driver\Session;

class AdminController extends BaseController
{

    protected $parentDueBalanceRepository;
    protected $parentPaymentTransactionRepository;

    public function __construct(ParentDueBalanceRepositoryInterface $parentDueBalanceRepository, ParentPaymentTransactionRepositoryInterface $parentPaymentTransactionRepository)
    {
        $this->parentDueBalanceRepository =  $parentDueBalanceRepository;
        $this->parentPaymentTransactionRepository = $parentPaymentTransactionRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index()
    {
        $parents = $this->parentDueBalanceRepository->all();
        return view('admin.parent-page', compact('parents'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function indexTransactions()
    {
        $transactions = $this->parentPaymentTransactionRepository->where('paid','1')->get();
        return view('admin.transactions-page', compact('transactions'));
    }

    public function import(Request $request)
    {
        $data = $request->validate([
            'file' => 'required',
            ]);
        $this->parentDueBalanceRepository->truncate();
        Excel::import(new ParentDueBalancesImport(), request()->file('file'));
        return redirect()->route('parents.index');
    }

    public function importView()
    {
        return view('admin.import');
    }
}
