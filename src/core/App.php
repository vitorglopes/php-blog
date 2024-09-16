<?php

namespace src\core;

use src\core\Router;

class App
{
    private $http;
    private $servername;
    private $serverport;
    private $requestUri;
    private $queryString;
    private $router;
    private $conf;

    public function __construct()
    {
        $this->setVars();
        $this->setSiteAddress();
        $this->conf = new Conf();
        $this->router = new Router($this->requestUri);
    }

    public function setVars(): void
    {
        $this->http = filter_var($_SERVER['HTTPS'] ?? '') == 'https' ? 'https' : 'http';
        $this->servername = filter_var($_SERVER['SERVER_NAME'], FILTER_SANITIZE_URL);
        $this->serverport = filter_var($_SERVER['SERVER_PORT']);
        $this->requestUri = filter_var($_SERVER['REQUEST_URI'] ?? '', FILTER_SANITIZE_URL);
        $this->queryString = filter_var($_SERVER['QUERY_STRING'] ?? '', FILTER_SANITIZE_URL);
    }

    public function setSiteAddress(): void
    {
        define('SITE_ADDRESS', $this->http . '://' . $this->servername . ':' . $this->serverport . '/');
        define('SITE_PUBLIC', SITE_ADDRESS . "public/");
        define('SITE_PUBLIC_IMG', SITE_ADDRESS . "public/img/");
        define('SITE_PUBLIC_CSS', SITE_ADDRESS . "public/css/");
        define('SITE_PUBLIC_JS', SITE_ADDRESS . "public/js/");
    }
}
