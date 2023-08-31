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
