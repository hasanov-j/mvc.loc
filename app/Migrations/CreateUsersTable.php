<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateUsersTable
{
    const TABLE_NAME='users';
    public static function up(): void
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
                            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                            uuid VARCHAR(255) UNIQUE,
                            firstname VARCHAR(40),
                            lastname VARCHAR(40),
                            phone VARCHAR(25),
                            email VARCHAR(50),
                            password VARCHAR(30),
                            avatar VARCHAR(255)
                            );";

        try{
            $result=$db->query($sql);
            ConsoleColorize::print(
                text: 'table '. self::TABLE_NAME. ' creating',
                color: ConsoleColorize::BLUE
            );

        } catch (\Exception $exception){
            ConsoleColorize::print(
                text: $exception->getMessage(),
                color: ConsoleColorize::RED
            );
            die;
        }

        ConsoleColorize::print(
            text: 'table '. self::TABLE_NAME. ' created',
            color: ConsoleColorize::GREEN
        );

    }

    public static function down(): void
    {
        Migration::tableDelete(self::TABLE_NAME);
    }
}