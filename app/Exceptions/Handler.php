<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Session\TokenMismatchException; // pour gérer l'erreur 419
use Symfony\Component\HttpKernel\Exception\RequestTimeoutException; // pour l'erreur 408
use Illuminate\Validation\ValidationException; // pour l'erreur 422

class Handler extends ExceptionHandler
{
    /**
     * A list of the types of exceptions that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
            // Customize how you log exceptions here.
        });

        $this->renderable(function (Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleException($request, Throwable $exception)
{
    if ($exception instanceof ModelNotFoundException) {
        logger()->info('ModelNotFoundException triggered');
        return view('publicView'); // Note que le tableau vide [] n'est pas nécessaire si aucune donnée n'est passée.
    }
    if ($exception instanceof NotFoundHttpException) {
        logger()->info('NotFoundHttpException triggered');
        return view('publicView');
    }
    if ($exception instanceof MethodNotAllowedHttpException) {
        return response()->view('errors.405', [], 405);
    }
    if ($exception instanceof UnauthorizedHttpException) {
        return response()->view('errors.401', [], 401);
    }
    if ($exception instanceof AuthorizationException) {
        return response()->view('errors.403', [], 403);
    }
    if ($exception instanceof TokenMismatchException) {
        return response()->view('errors.419', [], 419);
    }
    if ($exception instanceof HttpException) {
        $statusCode = $exception->getStatusCode();
        switch ($statusCode) {
            case 400:
                return response()->view('errors.400', [], 400);
            case 408:
                return response()->view('errors.408', [], 408);
            case 422:
                return response()->view('errors.422', [], 422);
            case 429:
                return response()->view('errors.429', [], 429);
            case 500:
                return response()->view('errors.500', [], 500);
            case 503:
                return response()->view('errors.503', [], 503);
            default:
                return response()->view("errors.default", ['code' => $statusCode], $statusCode); // Assurez-vous d'avoir une vue default.blade.php
        }
    }

    // Default to the parent class' implementation of handler
    return parent::render($request, $exception);
}


}
