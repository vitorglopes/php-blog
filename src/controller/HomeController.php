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
        echo "<br><br><br><br><br><br><br><pre>";
        $pagination = $this->PostServices->pagination();
        var_dump($pagination);
        $this->view('home/index');
    }
}
