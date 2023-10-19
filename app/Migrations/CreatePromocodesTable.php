<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreatePromocodesTable
{
    const TABLE_NAME="promocodes";
    public static function up(): void
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
                            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                            title VARCHAR(75),
                            description VARCHAR(255),
                            url_img VARCHAR(255),
                            discount INT,
                            value VARCHAR(255) UNIQUE,
                            is_advertising BOOLEAN
                            );";

        try {
            $db->query($sql);

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

    public static function down(): void
    {

        Migration::tableDelete(
            tableName: self::TABLE_NAME
        );
    }
}