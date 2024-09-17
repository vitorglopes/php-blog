<?php

namespace src\services;

use src\models\Posts;
use Illuminate\Database\Capsule\Manager;

class PostsService
{
    private $posts;
    public function __construct()
    {
        $this->posts = new Posts();
    }

    public function pagination()
    {
        $rowsPerPage = 10;
        $posts = Manager::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select(
                'posts.id as post_id',
                'posts.title',
                'posts.subtitle',
                'posts.content',
                'posts.registered_at',
                'users.id as user_id',
                'users.first_name',
                'users.last_name',
                'categories.id as category_id',
                'categories.description as category_desc'
            )
            ->orderBy('posts.registered_at', 'desc')
            ->paginate($rowsPerPage);

        $data = [];
        foreach ($posts as $item) {
            $data[] = [
                'id' => $item->post_id,
                'title' => $item->title,
                'subtitle' => $item->subtitle,
                'content' => $item->content,
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
