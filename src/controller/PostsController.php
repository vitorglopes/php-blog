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
        $postId = Util::requestSecure('sid', 'get');
        $data = $this->PostsService->view($postId);
        $this->view('posts/index', [
            'post' => $data
        ]);
    }

    public function edit()
    {
        $id = Util::requestSecure('sid', 'get');
        $this->view('posts/edit', []);
    }
}
