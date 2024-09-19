<?php

namespace src\services;

use DateTime;
use src\core\Util;
use src\models\Posts;
use Illuminate\Database\Capsule\Manager;

class PostsService
{
    private $posts;

    public function __construct()
    {
        $this->posts = new Posts();
    }

    public function read($id)
    {
        return $this->posts::find($id);
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
        $useCase = $req['useCase'] ?? '';
        $order = $req['order'] ?? '';
        $limit = $req['limit'] ?? '';
        $rowsPerPage = $req['rowsPerPage'] ?? 10;

        $query = Manager::table('posts')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select(
                'posts.id as post_id',
                'posts.title',
                'posts.subtitle',
                'posts.views',
                'posts.registered_at',
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

        if ($useCase == 'threads') {
            $date = new DateTime();
            $week = clone $date;
            $week->modify('monday this week');
            $query->where('posts.registered_at', '>=', $week->format('Y-m-d') . " 00:00:00");
        }

        if ($order == 'views') {
            $query->orderBy('posts.views', 'desc');
        } else {
            $query->orderBy('posts.registered_at', 'desc');
        }

        if ($limit > 0 && $limit != '') {
            $query->limit($limit);
        }

        $posts = $query->paginate($rowsPerPage);

        $data = [];
        foreach ($posts as $item) {
            $data[] = [
                'id' => Util::secureValue($item->post_id),
                'title' => $item->title,
                'subtitle' => $item->subtitle,
                'views' => $item->views,
                'registeredAt' => $item->registered_at,
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
