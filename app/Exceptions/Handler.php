<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use BadMethodCallException;
use ErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
        $this->reportable(function (Throwable $e) {
            //
        });

        // $this->renderable(function (NotFoundHttpException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response([
        //             'status' => false,
        //             'message' =>  str_contains($e->getMessage(), 'The route') ? 'Endpoint not found. If error persists, contact '.config('app.name').' customer care.' : (str_contains($e->getMessage(), 'No query results') ? str_replace(']', '', last(explode('\\', $e->getMessage()))) . ' not found.' : $e->getMessage())
        //         ]);
        //     }
        // });
        // $this->renderable(function (ServiceUnavailableHttpException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response([
        //             'status' => false,
        //             'message' => 'Server Error. If error persists, contact '.config('app.name').' customer care.'
        //         ], 500);
        //     }
        // });
        // $this->renderable(function (BadRequestHttpException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response([
        //             'status' => false,
        //             'message' => 'Invalid request'
        //         ]);
        //     }
        // });
        // $this->renderable(function (ErrorException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response([
        //             'status' => false,
        //             'message' => 'Failed to get service'
        //         ]);
        //     }
        // });
        // $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response([
        //             'status' => false,
        //             'message' => 'The method is not supported for this route.'
        //         ]);
        //     }
        // });
        // $this->renderable(function (BadMethodCallException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response([
        //             'status' => false,
        //             'message' => 'Invalid request. If error persists, contact '.config('app.name').' customer care.'
        //         ]);
        //     }
        // });
    }
}
