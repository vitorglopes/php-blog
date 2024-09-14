<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;

class ThreadsController extends Controller implements IController
{
    public function index()
    {
        $this->view('threads/index', []);
    }
}
