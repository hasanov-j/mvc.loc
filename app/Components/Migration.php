<?php

namespace App\Components;

class Migration
{
    public static function tableExits(string $tableName) : bool
    {
        $db = Database::getConnection();

        $sql = "SHOW TABLES LIKE '$tableName'";

        $message = "SHOW TABLES LIKE '$tableName'\n";

        try{
            $result = $db->query($sql);
            ConsoleColorize::print($message, ConsoleColorize::BLUE);
        }catch (\PDOException $e){
            ConsoleColorize::print($e->getMessage(), ConsoleColorize::RED);
            die;
        }

        ConsoleColorize::print($message, ConsoleColorize::GREEN);

        return $result->rowCount() > 0 ? true : false;
    }
}