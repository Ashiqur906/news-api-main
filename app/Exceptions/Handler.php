<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Response;
use Exception;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->renderable(function(TokenInvalidException $e, $request){
            return Response::json(['error'=>'Invalid token'],401);
        });
        $this->renderable(function (TokenExpiredException $e, $request) {
           return Response::json(['error'=>'Token has Expired'],401);
        });

        $this->renderable(function (JWTException $e, $request) {
           return Response::json(['error'=>'Token not parsed ! Please login first'],401);
        }); 
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return Response::json(['error'=>'Page not found'],404);
         });    
    }
}
