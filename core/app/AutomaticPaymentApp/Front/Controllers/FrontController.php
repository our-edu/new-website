<?php

namespace App\AutomaticPaymentApp\Front\Controllers;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use App\BaseApp\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontController extends BaseController
{
    public function searchNationalId(Request $request): Factory|View|Application
    {
        $data = $request->validate([
           'national_id' => 'required'
        ]);

        $NationalIdExistiDatabase = ParentDueBalance::where('national_id',$data['national_id'])->exists();
        //check if national id found in our edu users
//      if($request->national_id == 'found in our edu'){
//          return view('welcome')->with(['loginEnabled'=>true,'registerEnabled'=>false]);
//      //if it's found on automatic payment
//      }else if($request->national_id == 'automatic'){
//
//          return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>true]);
//          //not found at all
//      }else{
//          return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>false]);
//
//      }
    }
}