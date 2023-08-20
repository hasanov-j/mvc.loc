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

/**
 * Класс конектор с БД
 * Class Db.
 */
class Database
{
    public static ?PDO $pdoObject = null;

    public static function getConnection(): PDO
    {
        $paramsPath = CONFIG_ROOT.'db_params.php';

        $params = include $paramsPath;

        // PDO
        if (null === self::$pdoObject) {
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'], $params['password']);
            $db->exec('set names utf8');
            self::$pdoObject = $db;
        }

        return self::$pdoObject;
    }
}
