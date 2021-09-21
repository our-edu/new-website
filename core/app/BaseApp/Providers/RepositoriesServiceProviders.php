<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use App\CommunicationApp\Complains\Repository\ComplainRepository;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
use App\CommunicationApp\Announcements\Repository\AnnouncementRepository;
use App\CommunicationApp\Announcements\Repository\AnnouncementRepositoryInterface;
use App\CommunicationApp\Events\Repository\EventRepository;
use App\CommunicationApp\Events\Repository\EventRepositoryInterface;
use App\CommunicationApp\Questions\Repository\QuestionRepository;
use App\CommunicationApp\Questions\Repository\QuestionRepositoryInterface;
use App\CommunicationApp\Settings\Repository\GeneralSettingsRepository;
use App\CommunicationApp\Settings\Repository\GeneralSettingsRepositoryInterface;
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
        $this->app->bind(
            GeneralSettingsRepositoryInterface::class,
            GeneralSettingsRepository::class
        );
        $this->app->bind(
            AnnouncementRepositoryInterface::class,
            AnnouncementRepository::class
        );
        $this->app->bind(
            EventRepositoryInterface::class,
            EventRepository::class
        );
    }
}
