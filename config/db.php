<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost:8889;dbname=notebook',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    // время хранения данных в кэше (cек):
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
