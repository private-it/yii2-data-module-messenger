<?php
require __DIR__ . '/bootstrap.php';

$app = new yii\console\Application(array_replace_recursive(
    require(__DIR__ . '/config.php'),
    [
        'id' => 'console',
    ]
));

$app->runAction('migrate', [
    'migrationPath' => __DIR__.'/../src/migrations',
    'migrationTable' => 'migrations_yii2-data-module-messenger',
    'interactive' => 0
]);