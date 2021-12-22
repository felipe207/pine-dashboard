<?php

namespace App\Http\Middleware;
use Closure; 
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request,Closure $next)
    {
        if(Auth::user()->grupo_usuario_id == 1){
            return $next($request);
        } 

        if(Auth::user()->grupo_usuario_id == 2){
            return redirect()->back()->with('msg', 'Usuário sem permissão para acessar essa área.')->with('error', true);
        }
    }
}