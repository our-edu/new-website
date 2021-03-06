<?php

declare(strict_types = 1);

namespace App\BaseApp\Traits;

use App\BaseApp\Observers\ModelObserver;
use App\BaseApp\Scopes\BranchScope;
use Illuminate\Support\Facades\Auth;

trait HasBranch
{

    public static function bootHasBranch()
    {
    }
}
