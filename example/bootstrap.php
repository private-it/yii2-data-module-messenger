<?php
// Включение вывода ошибок
ini_set('display_errors', 1);
error_reporting(-1);

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('VENDOR_PATH') or define('VENDOR_PATH', __DIR__ . '/../vendor/');

require(VENDOR_PATH . '/autoload.php');
require(VENDOR_PATH . '/yiisoft/yii2/Yii.php');
    