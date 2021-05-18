<?php

declare(strict_types = 1);

namespace App\Exceptions;

use App\BaseApp\Exceptions\BaseErrorException;
use Czim\JsonApi\Exceptions\JsonApiValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, \Throwable $e)
    {
        if ($request->isJson() || $request->wantsJson()) {
            $this->jsonHandler($e);
        }
        return parent::render($request, $e);
    }

    public function jsonHandler($exception)
    {
        $debug = env('APP_DEBUG', false);
        if ($exception instanceof AuthenticationException) {
            throw new HttpResponseException(response()->json(
                ['errors' => [[
                    'status' => 403,
                    'title' => 'unauthorized_action',
                    'detail' => trans('app.Unauthorized action Please Use Authorized Token')
                ]]],
                403
            ));
        }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $title = 'resource_not_found';
            $detail = trans('app.Resource not found');


            if ($debug) {
                $title = $exception->getMessage() ?? '';
                $detail = $exception->getTrace();
            }

            throw new HttpResponseException(response()->json(
                ['errors' => [[
                    'status' => 404,
                    'title' => $title,
                    'detail' => $detail
                ]]],
                401
            ));
        }


        if ($exception instanceof TokenBlacklistedException) {
            throw new HttpResponseException(response()->json(
                ['errors' => [[
                    'status' => 401,
                    'title' => 'the_token_has_been_blacklisted',
                    'detail' => trans('app.The token has been blacklisted')
                ]]],
                401
            ));
        }

        if ($exception instanceof JsonApiValidationException) {
            $errorArray = [];
            $errors = $exception->getErrors();
            foreach ($errors as $name => $error) {
                $errorArray[] = [
                    'status' => 422,
                    'title' => $name,
                    'detail' => $error[0],
                ];
            }
            throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
        }


        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            throw new HttpResponseException(response()->json(
                ['errors' => [[
                    'status' => 403,
                    'title' => 'token_expired',
                    'detail' => trans('app.Unauthorized action Please Use a Valid Token')
                ]]],
                403
            ));
        }
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            throw new HttpResponseException(response()->json(
                ['errors' => [[
                    'status' => 403,
                    'title' => 'invalid token',
                    'detail' => trans('app.Unauthorized action Please Use a Valid Token')
                ]]],
                403
            ));
        }

        if ($exception instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
            throw new HttpResponseException(response()->json([
                'status' => 403,
                'title' => 'unauthorized_action',
                'detail' => trans('app.Unauthorized action')
            ], 403));
        }
        if ($exception instanceof BaseErrorException) {
            if ($exception->getCode() == 422) {
                $errors = [

                    [
                        'title' => trans('general.Validation Error'),
                        'detail' => $exception->getMessage(),
                        'status' => $exception->getCode(),
                    ]
                ];
                throw new HttpResponseException(response()->json([
                    'errors' => $errors], 422));
            }
            $title = 'oops_something_is_broken';
            $detail = trans('app.Oops Something is broken');

            $errors = [
                [
                    'status' => 500,
                    'title' => $title,
                    'detail' => $detail
                ]];
            if ($debug) {
                $line = $exception->getLine();
                $title = $exception->getMessage();
                $detail = $exception->getTrace();
                $file = $exception->getFile();


                $errors = [
                    [
                        'status' => 500,
                        'title' => $file,
                        'detail' => $file
                    ],
                    [
                        'status' => 500,
                        'title' => $title,
                        'detail' => $detail
                    ],
                    [
                        'status' => 500,
                        'title' => $line,
                        'detail' => $file
                    ]
                ];
            }

            throw new HttpResponseException(response()->json([
                'errors' => $errors], 500));
        }
    }
}
