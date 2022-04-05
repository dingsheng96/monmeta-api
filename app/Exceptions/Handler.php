<?php

namespace App\Exceptions;

use Throwable;
use App\Support\Facades\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {

            $response = ApiResponse::setMessage($exception->getMessage())
                ->setError($exception->getTrace());

            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
            } else {
                $response->setStatuscode(500);
            }

            return $response->toFailJson();
        }

        return parent::render($request, $exception);
    }
}
