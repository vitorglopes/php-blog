<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;

class HomeController extends Controller implements IController
{
    public function index()
    {
        $this->view('home/index');
    }
}
