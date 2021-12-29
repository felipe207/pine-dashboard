<?php

namespace Brediweb\BrediDashboard8\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;

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
        $this->info('Iniciando instalação...');

        $this->info('Instalando jetstream...');
        Artisan::call('jetstream:install livewire');
        // Remove Tailwind Configuration...
        // if ((new Filesystem)->exists(base_path('tailwind.config.js'))) {
        //     (new Filesystem)->delete(base_path('tailwind.config.js'));
        // }

        // Bootstrap Configuration...
        // copy(__DIR__.'/../../../../stubs/webpack.mix.js', base_path('webpack.mix.js'));
        // copy(__DIR__.'/../../../../stubs/webpack.config.js', base_path('webpack.config.js'));

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

        $this->info('Rodando as migrations...');
        Artisan::call('migrate');

        $this->info('Instalação finalizada...');
    }

}