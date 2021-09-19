<?php

namespace Tests;

use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->loadEnvironmentFrom('.env.testing');
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();


        return $app;
    }



    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh  --path=database/migrations/migration-test');
        $this->artisan('db:seed --class=UnitTestSeeder');
    }

    public function getJson($uri, array $headers = [])
    {
        $headers = array_merge($headers, [
            'accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ]);
        // return $headers;
        return $this->json('GET', $uri, [], $headers);
    }

    public function postJson($uri, array $data = [], array $headers = [])
    {
        $headers = array_merge($headers, [
            'accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ]);
        return $this->json('POST', $uri, $data, $headers);
    }

    public function putJson($uri, array $data = [], array $headers = [])
    {

        $headers = array_merge($headers, [
            'accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ]);
        return $this->json('PUT', $uri, $data, $headers);
    }

    public function deleteJson($uri, array $data = [], array $headers = [])
    {

        $headers = array_merge($headers, [
            'accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ]);
        return $this->json('DELETE', $uri, $data, $headers);
    }

    protected function authEmployee($id = null)
    {
        if ($id) {
            $user = User::find($id);
        } else {
            $user = User::where('type', 'employee')->first();
        }
        return $user;
    }

    protected function authParent($id = null)
    {
        if ($id) {
            $user = User::find($id);
        } else {
            $user = User::where('type', UserTypeEnum::PARENT)->first();
            //$user = User::factory(1)->create(['type', UserTypesEnum::PARENT]);
        }
        return $user;
    }

    protected function apiSignIn($user = null)
    {
        $user = $user ?: User::factory()->create();
        Auth::guard('api')->login($user);
        return $this;
    }

    protected function loginUsingHeader($user = null)
    {
        $user = $user ?: User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $header = ['Authorization' => 'Bearer '. $token];
        return $header;
    }

    public function clear()
    {
        $this->artisan('config:cache');
        $this->artisan('route:cache');
    }
}

