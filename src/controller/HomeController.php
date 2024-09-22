<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\services\PostsService;

class HomeController extends Controller implements IController
{
    private $PostServices;
    public function __construct()
    {
        $this->PostServices = new PostsService();
    }

    public function index()
    {
        $threads = $this->PostServices->pagination([
            'useCase' => 'threads',
            'rowsPerPage' => 5,
            'limit' => 5,
            'order' => 'views'
        ]);

        $lastsPosts = $this->PostServices->pagination([
            'useCase' => 'lastsPosts',
            'rowsPerPage' => 10,
            'limit' => 10,
            'order' => 'registered_at'
        ]);

        $this->view('home/index', [
            'threads' => $threads,
            'lastsPosts' => $lastsPosts
        ]);
    }
}
