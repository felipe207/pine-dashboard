<?php

namespace Brediweb\BrediDashboard\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the bredi dashboard 8';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem, Composer $composer)
    {
        parent::__construct();

        $this->files  = $filesystem;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->line('Iniciando instalação');
        
        $this->line('Testando Requisitos');
        // Test database connection
        try {
            DB::connection()->getPdo();
            $this->line('Conexão com o banco: ');
            $this->info('OK');
        } catch (\Exception $e) {
            $this->error('Erro de conexão com o banco! Verifique as configurações do .env.');
            $this->line("error: " .$e);
            return;
        }

        $this->info('Instalando jetstream...');
        Artisan::call('jetstream:install livewire');

        // Views
        $this->info('Copiando views...');
        $this->info('Auth');
        (new Filesystem)->deleteDirectory(resource_path('views/auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../Resources/views/auth', resource_path('views/auth'));
        
        $this->info('Controle');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/controle'));
        (new Filesystem)->copyDirectory(__DIR__.'/../Resources/views/controle', resource_path('views/controle'));
        
        $this->info('Includes');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/includes'));
        (new Filesystem)->copyDirectory(__DIR__.'/../Resources/views/includes', resource_path('views/includes'));
        
        $this->info('Layouts');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->copyDirectory(__DIR__.'/../Resources/views/layouts', resource_path('views/layouts'));
        
        copy(__DIR__.'/../Resources/views/404.blade.php', resource_path('views/404.blade.php'));
        copy(__DIR__.'/../Resources/views/dashboard.blade.php', resource_path('views/dashboard.blade.php'));
        
        // Assets...
        $this->info('Copiando assets...');
        (new Filesystem)->ensureDirectoryExists(public_path('assets'));
        (new Filesystem)->copyDirectory(__DIR__.'/../Public/assets', public_path('assets'));

        $user_model =  $this->files->get(app_path('Models').DIRECTORY_SEPARATOR.'User.php');
        $user_model = str_replace('use TwoFactorAuthenticatable;', 'use TwoFactorAuthenticatable;'.PHP_EOL."\t".'use HasRoles;', $user_model);
        $user_model = str_replace('use Illuminate\Foundation\Auth\User as Authenticatable;', 'use Illuminate\Foundation\Auth\User as Authenticatable;'.PHP_EOL.'use Spatie\Permission\Traits\HasRoles;', $user_model);
        $this->files->put(app_path('Models').DIRECTORY_SEPARATOR.'User.php', $user_model);
        
        $auth_service_provider =  $this->files->get(app_path('Providers').DIRECTORY_SEPARATOR.'AuthServiceProvider.php');
        $auth_service_provider = str_replace('$this->registerPolicies();', '$this->registerPolicies();'.PHP_EOL.''.PHP_EOL.
        "\t\t".'Gate::before(function ($user, $ability) {'.PHP_EOL.
        "\t\t\t".'return $user->hasRole("Administrador") ? true : null;'.PHP_EOL.
        "\t\t".'});', $auth_service_provider);
        $this->files->put(app_path('Providers').DIRECTORY_SEPARATOR.'AuthServiceProvider.php', $auth_service_provider);

        $kernel =  $this->files->get(app_path('Http').DIRECTORY_SEPARATOR.'Kernel.php');
        $kernel = str_replace('\Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,', '\Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,'.PHP_EOL.
        "\t\t"."'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,".PHP_EOL.
        "\t\t"."'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,".PHP_EOL.
        "\t\t"."'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,", $kernel);
        $this->files->put(app_path('Http').DIRECTORY_SEPARATOR.'Kernel.php', $kernel);

        $fortify_service_provider = $this->files->get(app_path('Providers').DIRECTORY_SEPARATOR.'FortifyServiceProvider.php');
        $fortify_service_provider = str_replace('Fortify::resetUserPasswordsUsing(ResetUserPassword::class);', 'Fortify::resetUserPasswordsUsing(ResetUserPassword::class);'.PHP_EOL.'
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LogoutResponse::class,
            \Brediweb\BrediDashboard\Http\Responses\LogoutResponse::class
        );', $fortify_service_provider);
        $this->files->put(app_path('Providers').DIRECTORY_SEPARATOR.'FortifyServiceProvider.php', $fortify_service_provider);

        $fortify_config = $this->files->get(config_path('fortify.php'));
        $fortify_config = str_replace('Features::registration(),', '// Features::registration(),', $fortify_config);
        $this->files->put(config_path('fortify.php'), $fortify_config);

        (new Filesystem)->append(base_path('routes/web.php'), $this->routeExemplo());

        $this->info('Rodando as migrations...');
        Artisan::call('migrate');

        $this->info('Instalação finalizada...');
    }

    protected function routeExemplo()
    {
        return <<<'EOF'
        
        Route::group([
            'prefix'        => 'controle/',
            'middleware'    => ['web', 'auth:sanctum', 'verified'],
            'as'            => 'controle.'
        ] ,function () {
        
            /*--------------------------------------------------------------------------
            | Rotas do controle (Exemplo)
            |--------------------------------------------------------------------------*/
            // Route::prefix('empreendimentos')->name('empreendimentos.')->group(function () {
            //     $controller = EmpreendimentoController::class;
            //     Route::get('/', [$controller, 'index'])->middleware('permission:Visualizar empreendimento')->name('index');
            //     Route::get('/create', [$controller, 'create'])->middleware('permission:Cadastrar empreendimento')->name('create');
            //     Route::post('/store', [$controller, 'store'])->middleware('permission:Cadastrar empreendimento')->name('store');
            //     Route::get('/edit/{id}', [$controller, 'edit'])->middleware('permission:Alterar empreendimento')->name('edit');
            //     Route::put('/update/{id}', [$controller, 'update'])->middleware('permission:Alterar empreendimento')->name('update');
            //     Route::delete('/delete/{id}', [$controller, 'delete'])->middleware('permission:Excluir empreendimento')->name('delete');
            // });
        
        });
        EOF;
    }

}