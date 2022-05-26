<p align="center">
    <h1 align="center">PROD+</h1>
    <br>
</p>

•	O sistema web foi desenvolvido na linguagem de programação PHP que utiliza o framework Yii2 para desenvolvimento ágil, o framework fornece uma arquitetura MVC (model, view e controller).

•	O framework disponbiliza segurança para o desenvolvedor pois suas instruções SQL são parametrizadas evitando ataques de injeção.

•	O frontend da aplicação utiliza o framework Bootstrap para estilizar a página.

•	O sistema web consome o backend em NodeJS através de chamadas via CURLs.

•	Após realizar autenticação no backend NodeJS é armazenado um token JWT na sessão na aplicação, que permite acessar os quadros do usuário.

•	O sistema web está hospedado na Heroku, onde fornece uma hospedagem gratuita.


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### Install via docker

Primeiramente realizar o download do docker e docker-compose
Basta digitar o comando a seguir na raiz do projeto:

~~~
docker-composer up
~~~

### Configuração do docker file

```php
php.dockerfile
```

Configuração
-------------

### Database local

criar um arquivo local .env com as seguintes variáveis:

```php
ENVIRONMENT=
HOST=
DB_USERNAME=
DB_PASSWORD=
DB_DATABASE=
DB_HOST=
DB_PORT=
DB_DIALECT=
DB_DRIVER=
```