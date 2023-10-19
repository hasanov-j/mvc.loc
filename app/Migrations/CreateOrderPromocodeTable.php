<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateOrderPromocodeTable extends Migration implements MigrationInterface
{
    const TABLE_NAME="order_promocode";

    public static function up(): void
    {
        $db=Database::getConnection();
        $sql="CREATE TABLE " . self::TABLE_NAME . " (
                            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                            order_id INT UNSIGNED,
                            FOREIGN KEY (order_id) REFERENCES orders (id) ON UPDATE CASCADE ON DELETE CASCADE,
                            promocode_id INT UNSIGNED,
                            FOREIGN KEY (promocode_id) REFERENCES promocodes (id) ON UPDATE CASCADE ON DELETE CASCADE
                            )";

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