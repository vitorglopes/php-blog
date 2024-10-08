<?php

namespace src\core;

use src\core\Util;
use src\core\Response;

class Controller
{
    public Response $response;

    public function __construct()
    {
        $this->response = new Response();
        $this->setDefaultPages();
    }

    public function setDefaultPages(): void
    {
        define('SITE_HOME', SITE_ADDRESS . "home/index");
        define('SITE_LOGIN', SITE_ADDRESS . "login/index");
    }

    public function view(string $view, $data = [])
    {
        require "src/views/$view.php";
    }

    public function redirect(string $route)
    {
        header("Location: " . SITE_ADDRESS . $route);
    }

    public function userLogged(string $returnToPage)
    {
        if (isset($_SESSION['login'])) {
            return true;
        }

        $this->view('login/index', [
            'returnToPage' => $returnToPage
        ]);
    }
}
