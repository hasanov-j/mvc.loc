<?php

namespace App\Components;

class Migration
{
    public static function tableExits(string $tableName): bool
    {
        $db = Database::getConnection();

        $sql = "SHOW TABLES LIKE '$tableName'";

        $message = "SHOW TABLES LIKE '$tableName";

        try {
            $result = $db->query($sql);
            ConsoleColorize::print($message, ConsoleColorize::BLUE);
        } catch (\PDOException $e) {
            ConsoleColorize::print($e->getMessage(), ConsoleColorize::RED);
            die;
        }

        ConsoleColorize::print($message, ConsoleColorize::GREEN);

        return $result->rowCount() > 0 ? true : false;
    }

    public static function tableDelete(string $tableName): void
    {
        $db = Database::getConnection();

        $sql = "DROP TABLE " . $tableName;

        $message = "table ". $tableName ." deleted successfully";

        try {
            if (self::tableExits($tableName)) {
                $result = $db->query($sql);
                ConsoleColorize::print("table ". $tableName ." deleting", ConsoleColorize::BLUE);
            } else {
                ConsoleColorize::print("table". $tableName ."already deleted", ConsoleColorize::BLUE);
            }

        } catch (\PDOException $e) {
            ConsoleColorize::print($e->getMessage(), ConsoleColorize::RED);
            die;
        }

        ConsoleColorize::print($message, ConsoleColorize::GREEN);

    }
}