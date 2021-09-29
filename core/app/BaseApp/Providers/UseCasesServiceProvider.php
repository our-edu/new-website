<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use App\CommunicationApp\Questions\UseCases\DeleteUseCases\DeleteQuestionUseCase;
use App\CommunicationApp\Questions\UseCases\DeleteUseCases\DeleteQuestionUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class UseCasesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            DeleteQuestionUseCaseInterface::class,
            DeleteQuestionUseCase::class
        );
    }
}
