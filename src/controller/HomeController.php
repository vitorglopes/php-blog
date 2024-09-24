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
            'rowsPerPage' => 6,
            'limit' => 6,
            'order' => 'views'
        ]);

        $lastsPosts = $this->PostServices->pagination([
            'useCase' => 'lastsPosts',
            'rowsPerPage' => 12,
            'limit' => 12,
            'order' => 'registered_at'
        ]);

        $this->view('home/index', [
            'threads' => $threads,
            'lastsPosts' => $lastsPosts
        ]);
    }
}
