<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $guarded = ['id'];
    public $timestamps = false;
}
