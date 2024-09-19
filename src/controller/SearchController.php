<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;

class SearchController extends Controller implements IController
{
    public function index()
    {
        $search = Util::request('q', 'get');
        $this->view('search/index', [
            'search' => $search
        ]);
    }
}
