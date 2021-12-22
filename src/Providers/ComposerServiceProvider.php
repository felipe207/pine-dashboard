<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Transacao;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('layouts.controle', function ($view) {

        //     $route = Route::current()->getAction();

        //     $transacao = Transacao::where('nome', $route['as'])->first();

        //     if ($transacao) {
        //         $active_menu = $transacao->categoriaTransacao->active_menu;
        //     } else {
        //         $active_menu = '';
        //     }

        //     return $view->with('active_menu', $active_menu);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
