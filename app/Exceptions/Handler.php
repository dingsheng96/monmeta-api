<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Log;
use App\Support\Facades\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
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

            Log::error($exception);

            $isProduction = app()->isProduction();

            $response = ApiResponse::setInternalServerErrorStatusCode()
                ->setError(!$isProduction ? $exception->getTrace() : array())
                ->setMessage(
                    !empty($exception->getMessage())
                        ? $exception->getMessage()
                        : trans('messages.api.default_error')
                );

            if ($exception instanceof AuthenticationException) {
                $response->setUnauthorizedStatusCode();
            } elseif ($exception instanceof ValidationException) {
                $response->setUnprocessableEntityStatusCode()
                    ->setError($exception->errors());

                Log::error(json_encode($exception));
            } elseif ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
            }

            return $response->toFailJson();
        }

        return parent::render($request, $exception);
    }
}
