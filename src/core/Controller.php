<?php

namespace src\core;

use src\core\Util;
use src\core\Response;

class Controller
{
    private Util $util;
    private Response $response;

    public function __construct()
    {
        $this->util = new Util();
        $this->response = new Response();
    }

    public function setDefaultPages()
    {
        define('SITE_HOME', SITE_ADDRESS . "home/index");
        define('SITE_LOGIN', SITE_ADDRESS . "login/index");
    }

    public function view(string $view, $data = [])
    {
        require "src/views/$view.php";
    }
}
