<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;

class TendenciasController extends Controller implements IController
{
    public function index()
    {
        $this->view('tendencias/index', []);
    }
}