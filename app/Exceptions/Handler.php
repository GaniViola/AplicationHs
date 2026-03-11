<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        
        // Custom handler for 404 errors
        $this->renderable(function (NotFoundHttpException $e) {
            // Anda bisa menambahkan logika tambahan di sini jika diperlukan
            // Misalnya mencatat halaman yang tidak ditemukan
            
            return response()->view('errors.404', [], 404);
        });
    }
}