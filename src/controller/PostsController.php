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
        parent::__construct();
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
        $this->userLogged('posts/edit');

        $sid = Util::request('sid', 'get');

        if ($sid === 'new') {
            $post = $this->PostsService->newPost($_SESSION['userId']);
        } else {
            $postId = Util::decodeValue($sid);
            $post = $this->PostsService->read($postId);
        }

        $categories = $this->PostsService->listCategories();

        return $this->view('posts/edit', [
            'data' => $post,
            'sid' => Util::secureValue($post->id),
            'categories' => $categories
        ]);
    }

    public function myposts()
    {
        $this->userLogged('posts/myposts');

        $data = $this->PostsService->pagination([
            'useCase' => 'myPosts',
            'userId' => Util::decodeValue($_SESSION['userId']),
            'rowsPerPage' => 10,
            'page' => Util::request('page', 'get'),
            'order' => 'registered_at'
        ]);

        $this->view('posts/myposts', [
            'posts' => $data
        ]);
    }

    public function api($action)
    {
        $id = Util::requestSecure('sid', 'get');
        $return = ['error' => true, 'msg' => ''];

        switch ($action) {
            case 'delete':
                $return = [
                    'data' => $this->PostsService->delete($id),
                    'error' => false,
                    'msg' => 'Ação concluída'
                ];
                break;

            case 'save':
                $req = [
                    'id' => $id,
                    'title' => Util::request('title'),
                    'subtitle' => Util::request('subtitle'),
                    'content' => Util::request('content'),
                    'status' => Util::request('status'),
                    'category' => Util::request('category')
                ];
                $return = $this->PostsService->update($req);
                break;

            default:
                break;
        }

        return $this->response::json($return);
    }
}
