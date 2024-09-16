<?php

use src\core\Conf;

require_once 'vendor/autoload.php';
$Conf = new Conf();

return [
    'dbname' => CONF['DB_NAME'],
    'user' => CONF['DB_USER'],
    'password' => CONF['DB_PASS'],
    'host' => CONF['DB_HOST'],
    'driver' => CONF['DB_DRIVER']
];
