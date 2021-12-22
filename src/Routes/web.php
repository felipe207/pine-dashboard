<?php

use App\Http\Controllers\Controle\ConfigController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Controle\UsuarioController;
use App\Http\Controllers\Controle\RoleController;
use App\Http\Controllers\Controle\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::any('controle/dashboard', function () {
        return view('index');
    })->name('dashboard');
 });

Route::get('img-render/{path}/{tamanho?}/{imagem?}', [
	'as' => 'imagem.render',
	'uses' => 'ImagemUploadController@imagemRender',
]);

Route::group([
    'middleware' => config('fortify.middleware', ['web'])
], function () {
    $enableViews = config('fortify.views', true);

    // Authentication...
    if ($enableViews) {
        Route::get('/controle', [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest:'.config('fortify.guard')])
            ->name('controle.login');
    }

    $limiter = ENV("REQUESTS_PER_MINUTE", 60);

    Route::post('/controle', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:'.config('fortify.guard'),
            $limiter ? 'throttle:'.$limiter : null,
        ]));
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware(['guest:'.config('fortify.guard')])
    ->name('verification.notice');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

});

Route::group([
    'prefix'        => 'controle/',
    'middleware'    => ['auth:sanctum', 'verified'],
    'as'            => 'controle.'
] ,function () {

    /*--------------------------------------------------------------------------
    | Rotas para configurações
    |--------------------------------------------------------------------------*/
    Route::prefix('configuracoes')->name('config.')->group(function () {
        $controller = ConfigController::class;
        Route::get('/form', [$controller, 'edit'])->middleware('permission:Alterar config')->name('edit');
        Route::post('/update', [$controller, 'update'])->middleware('permission:Alterar config')->name('update');
    });

    /*--------------------------------------------------------------------------
    | Rotas para perfil
    |--------------------------------------------------------------------------*/
    Route::prefix('perfil')->name('profile.')->group(function () {
        $controller = ProfileController::class;
        Route::get('/editar', [$controller, 'edit'])->middleware('permission:Alterar perfil')->name('edit');
        Route::post('/update', [$controller, 'update'])->middleware('permission:Alterar perfil')->name('update');
    });

    /*--------------------------------------------------------------------------
    | Rotas para roles / grupo de usuarios
    |--------------------------------------------------------------------------*/
    Route::prefix('grupo-usuario')->name('roles.')->group(function () {
        $controller = RoleController::class;
        Route::get('', [$controller, 'index'])->middleware('permission:Visualizar usuário')->name('index');
        Route::get('/cadastrar', [$controller, 'create'])->middleware('permission:Cadastrar usuário')->name('create');
        Route::post('/cadastrar', [$controller, 'store'])->middleware('permission:Cadastrar usuário')->name('store');
        Route::get('/alterar/{id}', [$controller, 'edit'])->middleware('permission:Alterar usuário')->name('edit');
        Route::post('/alterar/{id}', [$controller, 'update'])->middleware('permission:Alterar usuário')->name('update');
        Route::get('/excluir/{id}', [$controller, 'destroy'])->middleware('permission:Excluir usuário')->name('delete');
    });

    /*--------------------------------------------------------------------------
    | Rotas para o usuário
    |--------------------------------------------------------------------------*/
    Route::prefix('usuario')->name('usuario.')->group(function () {
        $controller = UsuarioController::class;
        Route::get('', [$controller, 'index'])->middleware('permission:Visualizar usuário')->name('index');
        Route::get('/cadastrar', [$controller, 'create'])->middleware('permission:Cadastrar usuário')->name('create');
        Route::post('/cadastrar', [$controller, 'store'])->middleware('permission:Cadastrar usuário')->name('store');
        Route::get('/editar/{id}', [$controller, 'edit'])->middleware('permission:Alterar usuário')->name('edit');
        Route::post('/editar/{id}', [$controller, 'update'])->middleware('permission:Alterar usuário')->name('update');
        Route::get('/excluir/{id}', [$controller, 'destroy'])->middleware('permission:Excluir usuário')->name('delete');
    });

    /*--------------------------------------------------------------------------
    | Rotas para banners
    |--------------------------------------------------------------------------*/
    Route::prefix('banner')->name('banner.')->group(function () {
        $controller = BannerController::class;
        Route::get('/', [$controller, 'index'])->middleware('permission:Visualizar banner')->name('index');
        Route::get('/form/{id?}', [$controller, 'form'])->middleware('permission:Cadastrar banner')->name('form');
        Route::post('/create', [$controller, 'store'])->middleware('permission:Cadastrar banner')->name('store');
        Route::post('/update/{id}', [$controller, 'update'])->middleware('permission:Alterar banner')->name('update');
        Route::get('/destroy/{id}', [$controller, 'destroy'])->middleware('permission:Excluir banner')->name('destroy');
        Route::get('/destroyImage/{id}/{img}', [$controller, 'destroyImage'])->middleware('permission:Excluir banner')->name('destroyImage');
    });
    
});