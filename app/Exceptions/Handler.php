<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

use Throwable;
use Illuminate\Http\Response;


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
   * Exception to method mapping for rendering.
   *
   * @var array
   */
  protected $exceptionHandlers = [
    ModelNotFoundException::class => 'handleModelNotFoundException',
    NotFoundHttpException::class => 'handleNotFoundHttpException',
  ];

  /**
   * Register the exception handling callbacks for the application.
   */
  public function register(): void
  {
    $this->reportable(function (Throwable $exception) {
    });

    $this->renderable(function (Throwable $exception, $request) {
      return $this->handleException($exception, $request);
    });
  }

  /**
   * Handle exceptions based on the type dynamically.
   */
  protected function handleException(Throwable $exception, $request)
  {
    foreach ($this->exceptionHandlers as $exceptionType => $method) {
      if ($exception instanceof $exceptionType) {
        return $this->$method($exception);
      }
    }
  }



  /**
   * Handle Model Not Found Exception.
   */
  protected function handleModelNotFoundException(ModelNotFoundException $exception)
  {
    $model = $exception->getModel();

    switch ($model) {
      case 'App\\Models\\Store':
        return $this->storeNotFoundResponse();
      case 'App\\Models\\Book':
        return $this->bookNotFoundResponse();
    }
  }

  /**
   * Handle Not Found HTTP Exception.
   */
  protected function handleNotFoundHttpException(NotFoundHttpException $exception)
  {
    if (str_contains($exception->getMessage(), 'No query results for model [App\\Models\\Store]')) {
      return $this->storeNotFoundResponse();
    }
  }

  /**
   * Return response when a Store model is not found.
   */
  protected function storeNotFoundResponse()
  {
    return response()->json([
      'error' => 'No results found for the requested Store model.'
    ], Response::HTTP_NOT_FOUND);
  }

  /**
   * Return response when a Book model is not found.
   */
  protected function bookNotFoundResponse()
  {
    return response()->json([
      'error' => 'No results found for the requested Book model.'
    ], Response::HTTP_NOT_FOUND);
  }
}
