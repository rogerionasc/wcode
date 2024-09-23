<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Verifica se a exceção é um erro 403 (AuthorizationException)
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {

                return Inertia::render('Errors/403') // Carrega a página Vue para 403
                    ->toResponse($request)
                    ->setStatusCode(403);
        }

        // Verifica se a exceção é um erro 404
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return Inertia::render('Errors/404') // Carrega a página Vue para 404
                ->toResponse($request)
                ->setStatusCode(404);
        }
        // Para outras exceções, use o comportamento padrão
        return parent::render($request, $exception);
    }
}
