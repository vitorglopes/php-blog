<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $guarded = ['id'];
    public $timestamps = false;
}
