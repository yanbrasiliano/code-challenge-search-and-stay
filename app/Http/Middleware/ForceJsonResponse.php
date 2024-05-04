<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
  protected $defaultAcceptHeader = 'application/json';

  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function handle(Request $request, Closure $next)
  {
    if ($request->header('Accept') !== $this->defaultAcceptHeader) {
      $request->headers->set('Accept', $this->defaultAcceptHeader);
    }

    try {
      $response = $next($request);

      if ($response instanceof Response && $response->headers->get('Content-Type') !== $this->defaultAcceptHeader) {
        $response->headers->set('Content-Type', $this->defaultAcceptHeader);
      }

      return $response;
    } catch (\Exception $excepetion) {
      return response()->json(['error' => $excepetion->getMessage()], 500);
    }
  }
}
