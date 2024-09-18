<?php

namespace src\core;

use DateTime;

class Util
{
    public static function request(string $var, string $type = 'post', int $filter = FILTER_DEFAULT): mixed
    {
        return filter_input($type == 'post' ? INPUT_POST : INPUT_GET, $var, $filter);
    }

    public static function requestSecure(string $var, string $type = 'post', int $filter = FILTER_DEFAULT)
    {
        $value = self::request($var, $type, $filter);
        return self::decodeValue($value);
    }

    public static function dateFromDb($dateStr)
    {
        $DateTime = new DateTime($dateStr);
        return $DateTime->format('d/m/Y') . " às " . $DateTime->format('H:i');
    }

    public static function secureValue($value)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        return base64_encode($value . '|' . $iv);
    }

    public static function decodeValue($strEncoded)
    {
        $value = explode('|', base64_decode($strEncoded));
        return $value[0];
    }
}
