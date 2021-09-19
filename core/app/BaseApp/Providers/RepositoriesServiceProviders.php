<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use App\CommunicationApp\Announcements\Repository\AnnouncementRepository;
use App\CommunicationApp\Announcements\Repository\AnnouncementRepositoryInterface;
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
            AnnouncementRepositoryInterface::class,
            AnnouncementRepository::class
        );
    }
}
