<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use App\CommunicationApp\Complains\Repository\ComplainRepository;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
use App\CommunicationApp\Questions\Repository\QuestionRepository;
use App\CommunicationApp\Questions\Repository\QuestionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            QuestionRepositoryInterface::class,
            QuestionRepository::class
        );
        $this->app->bind(
            ComplainRepositoryInterface::class,
            ComplainRepository::class
        );
    }
}
