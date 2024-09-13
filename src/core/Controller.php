<?php

namespace src\core;

class Controller
{
    public $homepage = SITE_ADDRESS . "home/index";

    public function __construct() {}

    public function view(string $view, $data = [])
    {
        require "src/views/$view.php";
    }
}
