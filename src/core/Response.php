<?php

namespace src\core;

class Response
{
    public function __construct() {}

    public static function json($value)
    {
        header("Content-Type: application/json");
        return print json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
