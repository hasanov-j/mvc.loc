<?php

declare(strict_types=1);

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateDishesTable extends Migration implements MigrationInterface
{
    const TABLE_NAME='dishes';
    public static function up(): void
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
                            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                            uuid VARCHAR(255) UNIQUE,
                            id_categories INT UNSIGNED,
                            FOREIGN KEY (id_categories) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE CASCADE,
                            name VARCHAR(50),
                            cost INT,
                            url VARCHAR(255),
                            search_synonyms JSON
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