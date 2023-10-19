<?php

declare(strict_types=1);

namespace App\Components;

class Session
{
    public static function set(string $name, array $value): void
    {
        $_SESSION[$name] = $value;
    }

    public static function get(string $name): array
    {
        return $_SESSION[$name];
    }

    public static function remove(string $name): void
    {
        unset($_SESSION[$name]);
    }
}
