<?php

declare(strict_types = 1);

namespace App\BaseApp\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class MorphToServiceProvider extends ServiceProvider
{
    /**
     * Boot method
     *
     * @return void
     */


    public function boot()
    {
        Relation::morphMap([
            'books'=>'App\NewWebsiteApp\Admin\Books\Book',
            'articles'=>'App\NewWebsiteApp\Admin\Articles\Article',
            'events'=>' App\NewWebsiteApp\Admin\Events\Event',
            'researches'=>'App\NewWebsiteApp\Admin\Researches\Research',
            'pages'=>'App\NewWebsiteApp\Admin\Pages\Page',

        ]);
    }
}
