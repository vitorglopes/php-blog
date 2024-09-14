<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;

class PostsController extends Controller implements IController
{
    public function index()
    {
        $this->new();
    }

    public function new()
    {
        $this->view('posts/index', []);
    }

    public function pageview(string $id) {}
}
