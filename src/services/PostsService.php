<?php

namespace src\services;

use DateTime;
use src\core\Util;
use src\models\Posts;
use Illuminate\Database\Capsule\Manager;

class PostsService
{
    private $Posts;

    public function __construct()
    {
        $this->Posts = new Posts();
    }

    public function read($id)
    {
        return $this->Posts::find($id);
    }

    public function newPost($userId)
    {
        $post = new Posts();
        $post->user_id = $userId;
        $post->category_id = 1;
        $post->views = 0;
        $post->title = '';
        $post->subtitle = '';
        $post->content = '';
        $post->registered_at = date('Y-m-d H:i:s');
        $post->status = 'draft';
        $post->save();

        return $post;
    }

    public function view($id)
    {
        $post = $this->read($id);
        $post->views = (int) $post->views + 1;
        $post->save();
        return $post;
    }

    public function pagination(array $req): array
    {
        $search = $req['search'] ?? '';
        $userId = $req['userId'] ?? '';
        $useCase = $req['useCase'] ?? '';
        $order = $req['order'] ?? '';
        $limit = $req['limit'] ?? '';
        $page = $req['page'] ?? '';
        $rowsPerPage = $req['rowsPerPage'] ?? 10;

        if ($useCase == 'search' && $search == "") {
            return [
                'data' => [],
                'currentPage' => 0,
                'lastPage' => 0,
                'total' => 0,
                'perPage' => 0,
            ];
        }

        $query = Manager::table('posts')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select(
                'posts.id as post_id',
                'posts.title',
                'posts.subtitle',
                'posts.views',
                'posts.registered_at',
                'posts.status',
                'users.id as user_id',
                'users.first_name',
                'users.last_name',
                'categories.id as category_id',
                'categories.description as category_desc'
            );

        if (!empty($search)) {
            $query->where('posts.title', 'like', "%$search%")
                ->orWhere('posts.subtitle', 'like', "%$search%");
        }

        if (!empty($userId) && $userId > 0) {
            $query->where('users.id', '=', $userId);
        }

        if ($useCase == 'threads') {
            $date = new DateTime();
            $week = clone $date;
            $week->modify('monday this week');
            $query->where('posts.registered_at', '>=', $week->format('Y-m-d') . " 00:00:00");
        }

        if ($useCase !== 'myPosts') {
            $query->where('posts.status', '=', 'ok');
        }

        if ($order == 'views') {
            $query->orderBy('posts.views', 'desc');
        } else {
            $query->orderBy('posts.registered_at', 'desc');
        }

        if ($limit > 0 && $limit != '') {
            $query->limit($limit);
        }

        $posts = $query->paginate($rowsPerPage, '*', 'page', $page);

        $data = [];
        foreach ($posts as $item) {
            $data[] = [
                'id' => Util::secureValue($item->post_id),
                'title' => $item->title,
                'subtitle' => $item->subtitle,
                'views' => $item->views,
                'registeredAt' => $item->registered_at,
                'status' => $item->status,
                'userId' => $item->user_id,
                'userFirstName' => $item->first_name,
                'userLastName' => $item->last_name,
                'categoryId' => $item->category_id,
                'categoryDescription' => $item->category_desc
            ];
        }

        return [
            'data' => $data,
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'total' => $posts->total(),
            'perPage' => $posts->perPage(),
        ];
    }
}
