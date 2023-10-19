<?php

declare(strict_types=1);

Namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateAboutTable extends Migration implements MigrationInterface
{
    const TABLE_NAME="about";
    public static function up(): void
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
                            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                            title VARCHAR(255) UNIQUE,
                            description TEXT,
                            image_url VARCHAR(255)
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

    public static function down(): void
    {
        Migration::tableDelete(
            tableName: self::TABLE_NAME
        );
    }
}