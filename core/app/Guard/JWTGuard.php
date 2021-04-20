<?php

namespace App\Guard;

use App\BaseApp\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWT;

class JWTGuard extends \Tymon\JWTAuth\JWTGuard implements Guard
{
    /**
     * Get the currently authenticated user or get the user from DB and authenticate him
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }
        if ($this->jwt->setRequest($this->request)->getToken() && $this->jwt->check()) {
            $id = $this->jwt->payload()->get('sub');
            $this->user = new User();
            $this->user->id = $id;
            $this->user= User::where('uuid',$id)->first();
            return $this->user;
        }
        return null;
    }
}