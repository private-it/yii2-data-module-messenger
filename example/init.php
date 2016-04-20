<?php
require __DIR__ . '/bootstrap.php';

$config = require(__DIR__ . '/config.php');
unset($config['components']['request']['cookieValidationKey']);
$app = new yii\console\Application(array_replace_recursive(
    $config,
    [
        'id' => 'console',
    ]
));

$app->runAction('migrate', [
    'migrationPath' => __DIR__.'/../src/migrations',
    'migrationTable' => 'migrations_yii2-data-module-messenger',
    'interactive' => 0
]);