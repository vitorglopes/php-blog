<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;
use src\services\LoginService;

class LoginController extends Controller implements IController
{
    private $LoginService;

    public function __construct()
    {
        parent::__construct();
        $this->LoginService = new LoginService();
    }

    public function index()
    {
        $returnToPage = Util::request('returnToPage');

        $this->view('login/index', [
            'returnToPage' => empty($returnToPage) ? 'home/index' : $returnToPage
        ]);
    }

    public function auth()
    {
        $email = Util::request('email', 'post', FILTER_SANITIZE_EMAIL);
        $passwd = Util::request('passwd');
        $returnToPage = !empty(Util::request('returnToPage')) ? Util::request('returnToPage') : 'home/index';

        $login = $this->LoginService->login($email, $passwd);

        if ($login['auth'] === true) {
            $this->redirect($returnToPage);
        }

        return $this->view('login/index', [
            'returnToPage' => $returnToPage,
            'error' => $login['error']
        ]);
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . SITE_HOME);
    }
}
