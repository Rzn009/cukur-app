<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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

        // Handle Authentication Exception
        $this->renderable(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated.',
                    'status' => 'error'
                ], 401);
            }
        });

        // Handle Authorization Exception
        $this->renderable(function (AuthorizationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'This action is unauthorized.',
                    'status' => 'error'
                ], 403);
            }
        });

        // Handle Model Not Found Exception
        $this->renderable(function (ModelNotFoundException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Resource not found.',
                    'status' => 'error'
                ], 404);
            }
        });

        // Handle Not Found Http Exception
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'The requested resource was not found.',
                    'status' => 'error'
                ], 404);
            }
        });

        // Handle Validation Exception
        $this->renderable(function (ValidationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $e->errors(),
                    'status' => 'error'
                ], 422);
            }
        });

        // Handle Token Mismatch Exception
        $this->renderable(function (TokenMismatchException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'CSRF token mismatch.',
                    'status' => 'error'
                ], 419);
            }
        });

        // Handle Spatie Permission Unauthorized Exception
        $this->renderable(function (UnauthorizedException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'User does not have the right permissions.',
                    'status' => 'error'
                ], 403);
            }
        });

        // Handle General Http Exception
        $this->renderable(function (HttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage() ?: 'An error occurred.',
                    'status' => 'error'
                ], $e->getStatusCode());
            }
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            return $this->handleApiException($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Handle API exceptions
     *
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse
     */
    private function handleApiException($request, Throwable $exception): JsonResponse
    {
        $debug = config('app.debug');
        $statusCode = $this->getStatusCode($exception);
        $response = [
            'message' => $this->getMessage($exception),
            'status' => 'error'
        ];

        if ($debug) {
            $response['debug'] = [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace()
            ];
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Get status code from exception
     *
     * @param Throwable $exception
     * @return int
     */
    private function getStatusCode(Throwable $exception): int
    {
        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        if ($exception instanceof ModelNotFoundException) {
            return 404;
        }

        if ($exception instanceof AuthenticationException) {
            return 401;
        }

        if ($exception instanceof AuthorizationException) {
            return 403;
        }

        if ($exception instanceof ValidationException) {
            return 422;
        }

        if ($exception instanceof TokenMismatchException) {
            return 419;
        }

        return 500;
    }

    /**
     * Get message from exception
     *
     * @param Throwable $exception
     * @return string
     */
    private function getMessage(Throwable $exception): string
    {
        if ($exception instanceof HttpException) {
            return $exception->getMessage() ?: 'An error occurred.';
        }

        if ($exception instanceof ModelNotFoundException) {
            return 'Resource not found.';
        }

        if ($exception instanceof AuthenticationException) {
            return 'Unauthenticated.';
        }

        if ($exception instanceof AuthorizationException) {
            return 'This action is unauthorized.';
        }

        if ($exception instanceof ValidationException) {
            return 'The given data was invalid.';
        }

        if ($exception instanceof TokenMismatchException) {
            return 'CSRF token mismatch.';
        }

        if ($exception instanceof UnauthorizedException) {
            return 'User does not have the right permissions.';
        }

        return 'An error occurred.';
    }
}
