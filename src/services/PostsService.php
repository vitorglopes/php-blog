<?php

namespace src\services;

use DateTime;
use src\core\Util;
use Illuminate\Database\Capsule\Manager;
use src\models\Categories;
use src\models\Comments;
use src\models\Posts;

class PostsService
{
    private $Categories;
    private $Comments;
    private $Posts;

    public function __construct()
    {
        $this->Categories = new Categories();
        $this->Comments = new Comments();
        $this->Posts = new Posts();
    }

    public function listCategories()
    {
        return $this->Categories::query()->orderBy('description', 'asc')->get();
    }

    public function read($id)
    {
        return $this->Posts::join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'categories.description as category_description', 'users.first_name', 'users.last_name')
            ->where('posts.id', $id)
            ->first();
    }

    public function update($req)
    {
        $post = $this->read($req['id']);

        if ($post->status == 'draft' && $req['status'] != 'draft') {
            $post->registered_at = date('Y-m-d H:i:s');
        }

        $post->title = $req['title'];
        $post->subtitle = $req['subtitle'];
        $post->content = $req['content'];
        $post->status = $req['status'];
        $post->category_id = $req['category'];
        $post->save();

        return [
            'data' => $post,
            'error' => false,
            'msg' => 'Ação concluída'
        ];
    }

    public function delete($id)
    {
        $return = $this->Posts::destroy($id);
        $this->deleteDir($id);
        return $return;
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

        $this->createDir($post->id);
        return $post;
    }

    public function createDir($id)
    {
        $dir = DOCUMENT_ROOT . "/public/storage/posts/$id";
        return mkdir($dir);
    }

    public function deleteDir($id)
    {
        $dir = DOCUMENT_ROOT . "/public/storage/posts/$id";
        return rmdir($dir);
    }

    public function view($id)
    {
        $post = $this->read($id);
        $post->views = (int) $post->views + 1;
        $post->save();
        return $post;
    }

    public function getPostComments($postId)
    {
        return $this->Comments::join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.id as userId', 'users.first_name as firstName', 'users.last_name as lastName')
            ->where('comments.post_id', $postId)
            ->orderBy('comments.registered_at', 'desc')
            ->get();
    }

    public function newComment(array $req)
    {
        $this->Comments->ref_comment_id = $req['refCommentId'];
        $this->Comments->post_id = $req['postId'];
        $this->Comments->user_id = $req['userId'];
        $this->Comments->content = $req['content'];
        $this->Comments->registered_at = date('Y-m-d H:i:s');
        $this->Comments->save();
        return $this->Comments;
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
