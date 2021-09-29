<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use DeleteQuestionUseCase;
use DeleteQuestionUseCaseInterface;
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
