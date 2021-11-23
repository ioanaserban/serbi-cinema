<?php

class User
{
    const CLIENT_ROLE = 1;
    const ADMIN_ROLE = 2;

    static function isAdmin()
    {
        return self::isLoggedIn() && ($_SESSION['user']['id'] == self::ADMIN_ROLE);
    }

    static function isLoggedIn()
    {
        session_start();

        return isset($_SESSION['user']['id']);
    }
}