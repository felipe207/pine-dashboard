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
Login inicial:

user: contato@bredi.com.br
senha: bredi
