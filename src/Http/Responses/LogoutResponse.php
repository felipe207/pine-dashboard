<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->route('controle.login');
    }
}