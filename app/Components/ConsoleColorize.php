<?php

declare(strict_types=1);


namespace App\Components;

use PDO;

/**
 * Класс конектор с БД
 * Class Db.
 */
class ConsoleColorize
{
    const RED = "\033[0;31m";
    const DEFAULT = "\033[0m";
    const BLACK = "\033[0;30m";
    const GREEN = "\033[0;32m";
    const YELLOW = "\033[0;33m";
    const BLUE = "\033[0;34m";
    const PURPLE = "\033[0;35m";
    const CYAN = "\033[0;36m";
    const WHITE = "\033[0;37m";

    const COLOR_VALUES = [
        self::RED,
        self::DEFAULT,
        self::BLACK,
        self::GREEN,
        self::YELLOW,
        self::BLUE,
        self::PURPLE,
        self::WHITE,
    ];

    public static function print($text, $color = self::DEFAULT) : void
    {
        $result = $text;

        if (in_array($color, self::COLOR_VALUES)) {

            switch ($color) {
                case self::RED: $result = $color . 'ERROR: '. $text . self::DEFAULT; break;
                case self::GREEN: $result = $color . 'SUCCESS: '.$text . self::DEFAULT;break;
                case self::YELLOW: $result = $color . 'WARNING: '.$text . self::DEFAULT;break;
                case self::BLUE: $result = $color . 'IN PROGRESS: '.$text . self::DEFAULT;break;
            }

        }

        echo $result . "\n";
    }
}
