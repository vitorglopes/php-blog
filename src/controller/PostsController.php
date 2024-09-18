<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;
use src\services\PostsService;

final class PostsController extends Controller
{
    private $PostsService;

    public function __construct()
    {
        $this->PostsService = new PostsService();
    }

    public function index()
    {
        $postId = Util::requestSecure('sid', 'get');
        $data = $this->PostsService->read($postId);
        $this->view('posts/index', [
            'post' => $data
        ]);
    }

    public function new()
    {
        $this->view('posts/new', []);
    }
}
