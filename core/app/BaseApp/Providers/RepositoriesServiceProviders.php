<?php

namespace App\BaseApp\Providers;

use App\PrintingPressApp\Documents\Repository\DocumentRepository;
use App\PrintingPressApp\Documents\Repository\DocumentRepositoryInterface;
use App\PrintingPressApp\Orders\Repository\OrderRepository;
use App\PrintingPressApp\Orders\Repository\OrderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProviders extends ServiceProvider
{
    public function register()
    {
      
    }
}
