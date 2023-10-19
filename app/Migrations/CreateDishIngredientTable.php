<?php

declare(strict_types=1);

Namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateDishIngredientTable extends Migration implements MigrationInterface
{
    const TABLE_NAME="dish_ingredient";
    public static function up(): void
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
                            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                            id_ingredients INT UNSIGNED,
                            FOREIGN KEY (id_ingredients) REFERENCES ingredients(id) ON UPDATE CASCADE ON DELETE CASCADE,
                            id_dishes INT UNSIGNED,
                            FOREIGN KEY (id_dishes) REFERENCES dishes(id) ON UPDATE CASCADE ON DELETE CASCADE
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