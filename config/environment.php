<?php

$dir = "../.env";



// @DESC env file
if(file_exists($dir)) {
    
    $lines = file( $dir );

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
        echo ".env not completed!";
        die();
    }
} else {
    echo ".env nothing found!";
    die();
}
