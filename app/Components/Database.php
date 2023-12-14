<?php

declare(strict_types=1);


namespace App\Components;

use PDO;

/**
 * Класс конектор с БД
 * Class Db.
 */
class Database
{
    public static ?PDO $pdoObject = null;

    public static function getConnection(): PDO
    {
        $paramsPath = './config/db_params.php';

        $params = include $paramsPath;


        // PDO
        if (null === self::$pdoObject) {

            try {
                $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
                $db = new PDO($dsn, $params['user'], $params['password']);
                $db->exec('set names utf8');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoObject = $db;
            } catch (\PDOException $e) {
                ConsoleColorize::print($e->getMessage(), ConsoleColorize::RED);
                die;
            } catch (\Exception $e) {

                ConsoleColorize::print($e->getMessage(), ConsoleColorize::RED);
                die;
            }
        }

        return self::$pdoObject;
    }

}
