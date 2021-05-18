<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use App\PrintingPressApp\Orders\Seller\UseCases\listOrdersUseCase\listOrdersUseCase;
use App\PrintingPressApp\Orders\Seller\UseCases\listOrdersUseCase\listOrdersUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class UseCasesServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
}
