<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;

class PesquisaController extends Controller implements IController
{
    public function index()
    {
        $search = Util::request('search');
        $this->view('pesquisa/index', [
            'search' => $search
        ]);
    }
}
