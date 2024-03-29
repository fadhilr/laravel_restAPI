<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->json([
                    'error'     => 'Unauthorized'
                ],401);
            }
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response()->json([
                    'error'     => 'Not found'
                ], 404);
            }
            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                $modelClass= explode('\\', $exception->getmodel());

                return response()->json([
                    'error'     => end($modelClass).' not found'
                ], 404);
            }
            // if ($exception instanceof \Symfony\Component\Debug\Exception\FatalThrowableError) {
            //     $modelClass= explode('\\', $exception->getmodel());

            //     return response()->json([
            //         'error'     => end($modelClass).' not found'
            //     ], 500);
            // }
        }

        return parent::render($request, $exception);
    }
}
