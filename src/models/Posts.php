<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $guarded = ['id'];
    public $timestamps = false;
}
