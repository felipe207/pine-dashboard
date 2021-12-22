<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ValidaPermissao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset(Route::current()->action['permissao'])) {
            $this->verificaPermissao(Route::current()->action['permissao']);
        }

        return $next($request);
    }

    public function verificaPermissao($transacao)
    {
        if (Gate::denies($transacao)) {
            $this->forbidden();
        }
    }

    public function forbidden()
    {
        Log::alert('Usuário sem permissão para acessar URL', [Auth::user()->nome, url()->current()]);
        abort(403);
    }
}
