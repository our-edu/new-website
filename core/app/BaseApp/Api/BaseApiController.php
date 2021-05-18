<?php

declare(strict_types = 1);

namespace App\BaseApp\Api;

use App\Http\Controllers\Controller;
use App\BaseApp\Api\Traits\ApiResponser;

class BaseApiController extends Controller
{
    use ApiResponser;
}
