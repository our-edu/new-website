<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
//        $this->artisan('migrate:fresh --seed');
    }

    public function getJson($uri, array $headers = [])
    {
        $headers = array_merge($headers, [
            'accept'=>'application/vnd.api+json',
            'Content-Type'=>'application/vnd.api+json',
        ]);
        return $this->json('GET', $uri, [], $headers);
    }

    public function postJson($uri, array $data = [], array $headers = [])
    {
        $headers = array_merge($headers, [
            'accept'=>'application/vnd.api+json',
            'Content-Type'=>'application/vnd.api+json',
        ]);
        return $this->json('POST', $uri, $data, $headers);
    }

    public function putJson($uri, array $data = [], array $headers = [])
    {

        $headers = array_merge($headers, [
            'accept'=>'application/vnd.api+json',
            'Content-Type'=>'application/vnd.api+json',
        ]);
        return $this->json('PUT', $uri, $data, $headers);
    }
    public function deleteJson($uri, array $data = [], array $headers = [])
    {

        $headers = array_merge($headers, [
            'accept'=>'application/vnd.api+json',
            'Content-Type'=>'application/vnd.api+json',
        ]);
        return $this->json('DELETE', $uri, $data, $headers);
    }

//    protected function disableExceptionHandling()
//    {
//        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
//
//        $this->app->instance(ExceptionHandler::class, new class extends Handler {
//            public function __construct()
//            {
//            }
//            public function report(\Exception $e)
//            {
//            }
//            public function render($request, \Exception $e)
//            {
//                throw $e;
//            }
//        });
//    }
//
//    protected function withExceptionHandling()
//    {
//        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
//
//        return $this;
//    }
}
