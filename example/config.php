<?php
return [
    'id' => 'app',
    'basePath' => __DIR__,
    'vendorPath' => VENDOR_PATH,
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => YII_DEBUG ? 60 : 3600,

            'dsn' => 'pgsql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => 'tZztk8oSAZzGakLXWvs80bF4d',
        ],
        'request' => [
            'cookieValidationKey' => 'test'
        ]
    ]
];