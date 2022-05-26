<?php

// @DESC verifico se está em PRD
if (getenv('ENVIRONMENT')) {

    define('ENVIRONMENT', getenv('ENVIRONMENT'));
    define('HOST',        getenv('HOST'));
    define('DB_USERNAME', getenv('DB_USERNAME'));
    define('DB_PASSWORD', getenv('DB_PASSWORD'));
    define('DB_DATABASE', getenv('DB_DATABASE'));
    define('DB_HOST',     getenv('DB_HOST'));
    define('DB_PORT',     getenv('DB_PORT'));
    define('DB_DIALECT',  getenv('DB_DIALECT'));
    define('DB_DRIVER',   getenv('DB_DRIVER'));

} else {

    // @DESC local do .env
    $dir = "../.env";

    // @DESC se não estiver em producao acesso o arquivo local .env
    if(file_exists($dir)) {
        
        // @DESC lendo cada linha do arquivo .env
        $lines = file( $dir );

        // @DESC verificando as variaveis estao completas
        if (count($lines) == 9) {
            
            define('ENVIRONMENT', trim(end(explode("=",$lines[0]))));
            define('HOST',        trim(end(explode("=",$lines[1]))));
            define('DB_USERNAME', trim(end(explode("=",$lines[2]))));
            define('DB_PASSWORD', trim(end(explode("=",$lines[3]))));
            define('DB_DATABASE', trim(end(explode("=",$lines[4]))));
            define('DB_HOST',     trim(end(explode("=",$lines[5]))));
            define('DB_PORT',     trim(end(explode("=",$lines[6]))));
            define('DB_DIALECT',  trim(end(explode("=",$lines[7]))));
            define('DB_DRIVER',   trim(end(explode("=",$lines[8]))));

        } else {
            // @DESC arquivo .env fora do padrao
            echo ".env not completed!";
            die();
        }

    } else {

        // @DESC arquivo .env nao existe
        echo ".env nothing found!";
        die();

    }
}
