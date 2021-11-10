<?php

namespace App\AutomaticPaymentApp\Front\Controllers;

use App\BaseApp\Controllers\BaseController;
use Illuminate\Http\Request;

class FrontController extends BaseController
{
    public function searchNationalId(Request $request)
    {
        dd($request->all());
    }
}