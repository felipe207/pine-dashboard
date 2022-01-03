# bredi-dashboard-8
Pacote dashboard para projetos Laravel 8

## Instruções de uso
### Instalando o pacote
1 - Adicione as seguintes dependências ao composer.json do seu projeto:

Em require:
```json
"brediweb/bredi-dashboard-8": "dev-main",
"brediweb/imagemupload-8": "dev-main",
```

Ao final do arquivo, adicione:
```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/brediweb/imagem-upload-8"
    },
    {
        "type": "vcs",
        "url": "https://github.com/brediweb/bredi-dashboard-8"
    }
]
```

2 - Instalação:

Faça a instalação do composer:
```bash
composer install
```
Se é a primeira vez que você irá instalar o pacote, será pedido um token, referênte aos repositórios da Bredi no github, solicite a mesma ao Erick ou ao Michel.

3 - Após instalar o pacote, execute o seguinte comando:

OBS: Antes de rodar este comando, lembre-se de configurar corretamente o arquivo .env
```bash
php artisan dashboard:install
```

### Rotas

Exemplo de rotas do controle

```PHP
Route::group([
    'prefix'        => 'controle/',
    'middleware'    => ['web', 'auth:sanctum', 'verified'],
    'as'            => 'controle.'
] ,function () {

    /*--------------------------------------------------------------------------
    | Adicione as rotas do controle aqui dentro
    |--------------------------------------------------------------------------*/

    ...

    /*--------------------------------------------------------------------------
    | Rotas para Gerenciamento de Empreendimentos
    |--------------------------------------------------------------------------*/
    Route::prefix('empreendimentos')->name('empreendimentos.')->group(function () {
        $controller = EmpreendimentoController::class;
        Route::get('/', [$controller, 'index'])->middleware('permission:Visualizar empreendimento')->name('index');
        Route::get('/create', [$controller, 'create'])->middleware('permission:Cadastrar empreendimento')->name('create');
        Route::post('/store', [$controller, 'store'])->middleware('permission:Cadastrar empreendimento')->name('store');
        Route::get('/edit/{id}', [$controller, 'edit'])->middleware('permission:Alterar empreendimento')->name('edit');
        Route::put('/update/{id}', [$controller, 'update'])->middleware('permission:Alterar empreendimento')->name('update');
        Route::delete('/delete/{id}', [$controller, 'delete'])->middleware('permission:Excluir empreendimento')->name('delete');
    });

    ...

});
```