<?php

namespace src\core;

class Util
{
    public static function request(string $var, string $type = 'post', int $filter = FILTER_DEFAULT): mixed
    {
        $type = $type == 'post' ? INPUT_POST : INPUT_GET;
        return filter_input($type, $var, $filter);
    }
}
