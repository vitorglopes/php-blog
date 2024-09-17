<?php

namespace src\core;

use Illuminate\Database\Capsule\Manager;

$Manager = new Manager();
$Manager->addConnection([
    'driver'    => CONF['DB_DRIVER'],
    'host'      => CONF['DB_HOST'],
    'database'  => CONF['DB_NAME'],
    'username'  => CONF['DB_USER'],
    'password'  => CONF['DB_PASS'],
    'charset'   => CONF['DB_CHARSET'],
    'collation' => CONF['DB_COLLATION'],
    'prefix'    => '',
]);

$Manager->setAsGlobal();
$Manager->bootEloquent();
