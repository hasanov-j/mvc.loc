<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateSlidersTable extends Migration implements MigrationInterface
{
    const TABLE_NAME = 'sliders';

    public static function up()
    {

        $db = Database::getConnection();

        if (self::tableExits(self::TABLE_NAME)) {
            echo "table" . self::TABLE_NAME . "already exists";
        } else {

            $sql = "CREATE TABLE " . self::TABLE_NAME . "(
                  id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                  uuid VARCHAR(255) UNIQUE,
                  url VARCHAR(255),
                  description VARCHAR(75)
                  );";

            try {

                $result = $db->query($sql);

                ConsoleColorize::print(
                    text: "table". self::TABLE_NAME. "creating ",
                    color: ConsoleColorize::BLUE
                );

            } catch (\PDOException $e) {
                ConsoleColorize::print(
                    text: $e->getMessage(),
                    color: ConsoleColorize::RED
                );
                die;
            }

            ConsoleColorize::print(
                text: "table". self::TABLE_NAME. "successfully created",
                color: ConsoleColorize::GREEN
            );
            die;

        }

    }

    public static function down()
    {
        self::tableDelete(self::TABLE_NAME);
    }
}