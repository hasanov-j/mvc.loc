<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Components;

class Cookie
{
    public const DEFAULT_COOKIE_LIFETIME = 86400 * 30; // месяц
    public const DEFAULT_COOKIE_TIME_OF_DEATH = -86400; // месяц
    public const DEFAULT_COOKIE_PATH = '/';
    public const DEFAULT_COOKIE_DOMAIN = SITE_HOSTNAME;
    public const DEFAULT_COOKIE_SECURITY = false;
    public const DEFAULT_COOKIE_HTTPONLY = true; // js cookie availability (access to cookie by js script)

    public static function get(string $name): string
    {
        return $_COOKIE[$name];
    }

    public static function set(
        string $name,
        string $value,
        int $timeInSeconds = self::DEFAULT_COOKIE_LIFETIME,
    ): bool {
        return setcookie(
            name: $name,
            value: $value,
            expires_or_options: time() + $timeInSeconds,
            path: self::DEFAULT_COOKIE_PATH,
            domain: self::DEFAULT_COOKIE_DOMAIN,
            secure: self::DEFAULT_COOKIE_SECURITY,
            httponly: self::DEFAULT_COOKIE_HTTPONLY,
        );
    }

    public static function remove(string $name): bool
    {
        return setcookie(
            name: $name,
            value: '',
            expires_or_options: time() + self::DEFAULT_COOKIE_TIME_OF_DEATH,
        );
    }
}
