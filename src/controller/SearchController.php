<?php

namespace src\controller;

use src\core\Controller;
use src\core\IController;
use src\core\Util;
use src\services\PostsService;

class SearchController extends Controller implements IController
{
    private $PostsService;

    public function __construct()
    {
        $this->PostsService = new PostsService();
    }

    public function index()
    {
        $search = Util::request('q', 'get');

        $data = $this->PostsService->pagination([
            'useCase' => 'search',
            'search' => $search,
            'rowsPerPage' => 20,
            'order' => 'registered_at'
        ]);

        $this->view('search/index', [
            'search' => $search,
            'data' => $data
        ]);
    }
}
