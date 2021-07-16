<?php


namespace App;


class TokenGenerator
{
    public static function generateToken(): string
    {
        return base64_encode(Config::API_KEY_ADMIN);

}
}