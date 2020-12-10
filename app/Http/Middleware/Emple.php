<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
class Emple
{
   
    /**
     * Implementación de Guard.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Crea una nueva instancia de filtro.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->emple()) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}