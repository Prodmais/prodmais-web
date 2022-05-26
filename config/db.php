<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => DB_DRIVER.':host='.DB_HOST.';dbname='.DB_DIALECT.'',
    'username' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    // 'enableSchemaCache' => true,
    // 'schemaCacheDuration' => 60,
    // 'schemaCache' => 'cache',
];
