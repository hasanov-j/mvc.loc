<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateTestTable extends Migration implements MigrationInterface
{
    const TABLE_NAME = 'users';

    public static function up()
    {
        $db = Database::getConnection();

        if (self::tableExits(self::TABLE_NAME)) {
            ConsoleColorize::print(
                text:sprintf("Table - %s already exist", self::TABLE_NAME),
                color:  ConsoleColorize::RED
            ); die;
        }

        $sql = "CREATE TABLE " . self::TABLE_NAME . "(
                id INTEGER AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30),
                lastname VARCHAR(30),
                age INTEGER,
                phone VARCHAR(15),
                country VARCHAR(50),
                city VARCHAR(25)
            )";

        try{
            $db->query($sql);

            ConsoleColorize::print(
                text:sprintf("Table - %s successful created", self::TABLE_NAME),
                color:  ConsoleColorize::GREEN
            ); die;

        }catch (\Exception $exception){

            ConsoleColorize::print(
                text:sprintf("Something going wrong: %s", $exception->getMessage()),
                color:  ConsoleColorize::RED
            ); die;
        }

    }

    public static function down()
    {
//        if (self::tableExits(self::TABLE_NAME)) {
//            //TODO: скрипт по удалению таблицы
//            $db = Database::getConnection();
//
//            $sql = "DROP TABLE" . self::TABLE_NAME;
//            $result = $db->query($sql);
//        } else {
//            echo "Table has deleted already";
//        }
    }
}