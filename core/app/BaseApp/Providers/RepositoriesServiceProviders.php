<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use App\AutomaticPaymentApp\Repository\ParentDueBalanceRepository;
use App\AutomaticPaymentApp\Repository\ParentDueBalanceRepositoryInterface;
use App\AutomaticPaymentApp\Repository\ParentPaymentTransactionRepository;
use App\AutomaticPaymentApp\Repository\ParentPaymentTransactionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ParentDueBalanceRepositoryInterface::class,
            ParentDueBalanceRepository::class
        );


        $this->app->bind(
            ParentPaymentTransactionRepositoryInterface::class,
            ParentPaymentTransactionRepository::class
        );
    }
}
