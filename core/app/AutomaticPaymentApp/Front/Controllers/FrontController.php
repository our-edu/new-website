<?php

namespace App\AutomaticPaymentApp\Front\Controllers;

use App\BaseApp\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontController extends BaseController
{
    public function searchNationalId(Request $request): Factory|View|Application
    {
        //check if national id found in our edu users
      if($request->national_id == 'found'){
          return view('welcome')->with(['loginEnabled'=>true,'registerEnabled'=>false]);
      //if it's found on automatic payment
      }else if($request->national_id == 'automatic'){
          return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>true]);
          //not found at all
      }else{
          return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>false]);

      }
    }
}