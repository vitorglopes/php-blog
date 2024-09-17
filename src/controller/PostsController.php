<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;
use src\services\PostsService;

class PostsController extends Controller implements IController
{
    private $PostsService;

    public function __construct()
    {
        $this->PostsService = new PostsService();
    }

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
