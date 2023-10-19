<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateDishOrderTable extends Migration implements MigrationInterface
{
    const TABLE_NAME='dish_order';


    public static function up()
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE " . self::TABLE_NAME . " (
                               id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                               uuid VARCHAR(255) UNIQUE,
                               order_id INT UNSIGNED,
                               FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE ON UPDATE CASCADE,
                               dish_id INT UNSIGNED,
                               FOREIGN KEY (dish_id) REFERENCES dishes (id) ON DELETE CASCADE ON UPDATE CASCADE,
                               quantity INT UNSIGNED
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

    public static function down()
    {
        Migration::tableDelete(self::TABLE_NAME);
    }
}