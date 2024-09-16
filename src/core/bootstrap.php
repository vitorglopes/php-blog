<?php

namespace src\core;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Setup;

$paths = [DOCUMENT_ROOT . '/src/entities'];
$isDevMode = false;

$dbParams = [
    'driver'   => CONF['DB_DRIVER'],
    'user'     => CONF['DB_USER'],
    'password' => CONF['DB_PASS'],
    'dbname'   => CONF['DB_NAME']
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);
