<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateHeadersTable extends Migration implements MigrationInterface
{
    const TABLE_NAME="headers";
    public static function up(){
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
                            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            uuid VARCHAR(255) UNIQUE,
                            name VARCHAR(75),
                            url VARCHAR(255)
                            );";

        try {
            $result=$db->query($sql);
            ConsoleColorize::print(
                text: 'table '. self::TABLE_NAME. ' creating',
                color: ConsoleColorize::BLUE
            );
        } catch (\PDOException $e){

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );
            die;

        }

        ConsoleColorize::print(
            text: 'table '. self::TABLE_NAME. ' created',
            color: ConsoleColorize::GREEN
        );

    }

    public static function down() {
        Migration::tableDelete(
            tableName: self::TABLE_NAME
        );
    }
}