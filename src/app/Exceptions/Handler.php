<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exception\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson())
            return $this->handleApiException($exception);

        return parent::render($request, $exception);
    }

    /**
     * Handle exception and convert it to API
     *
     * @param Exception $exception
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function handleApiException(Exception $exception)
    {
        // Form a basic response
        $statusCode = 500;
        $message = __("http_status.$statusCode");
        $res = ['status' => $statusCode, 'message' => $message];
        
        // This will replace our 404 response of MODEL NOT FOUND with a json response
        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            // Get the exception class name, either 'ModelNotFoundException' or 'NotFoundHttpException'
            $exceptionFullNameArr = explode('\\', \get_class($exception));
            $exceptionName = $exceptionFullNameArr[count($exceptionFullNameArr)-1];

            $statusCode = 404;
            $message = __("http_status.$statusCode.$exceptionName");
            $res = ['status' => $statusCode, 'message' => $message];
        }
        // This will replace our 405 response of METHOD NOT ALLOWED with a json response
        else if ($exception instanceof MethodNotAllowedHttpException) {
            $statusCode = 405;
            $message = __("http_status.$statusCode");
            $res = ['status' => $statusCode, 'message' => $message];
        }
        // This will replace our 401 response from AuthenticationException with a json response
        else if ($exception instanceof AuthenticationException) {
            $statusCode = 401;
            $message = __("http_status.$statusCode");
            $res = ['status' => $statusCode, 'message' => $message];
        }
        // This will replace our 403 response from AuthorizationException with a json response
        else if ($exception instanceof AuthorizationException) {
            $statusCode = 403;
            $message = __("http_status.$statusCode");
            $res = ['status' => $statusCode, 'message' => $message];
        }
        // This will replace our 400 response from ValidationException with a json response
        else if ($exception instanceof ValidationException) {
            $statusCode = $exception->status;
            // $message = __("http_status.$statusCode");
            $message = $exception->original['message'];
            $errors = $exception->errors();
            $res = ['status' => $statusCode, 'message' => $message, 'errors' => $errors];
        }
        // Exception for common error and custom message if any
        else {
            if (method_exists($exception, 'getStatusCode'))
                $statusCode = $exception->getStatusCode();
            if (method_exists($exception, 'getMessage'))
                $message = $exception->getMessage();
            
            $res = ['status' => $statusCode, 'message' => $message];
            
            if (config('app.debug')) {
                if (method_exists($exception, 'getCode'))
                    $res['code'] = $exception->getCode();
                if (method_exists($exception, 'getFile'))
                    $res['file'] = $exception->getFile();
                if (method_exists($exception, 'getLine'))
                    $res['line'] = $exception->getLine();
                if (method_exists($exception, 'getTrace'))
                    $res['trace'] = $exception->getTrace();
            }
        }

        return response($res, $statusCode);
    }
}
