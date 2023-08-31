<?php

declare(strict_types=1);

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateFeedbacksTable extends Migration implements MigrationInterface
{
    const TABLE_NAME = 'feedbacks';

    public static function up()
    {

        $db = Database::getConnection();

        if (self::tableExits(self::TABLE_NAME)) {
            echo "table " . self::TABLE_NAME . "already exists";
        } else {

            $sql = "CREATE TABLE " . self::TABLE_NAME . "(
                  id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                  firstname VARCHAR(25),
                  lastname VARCHAR(25),
                  phone VARCHAR(30),
                  email VARCHAR(25),
                  comment TEXT
                  );";

            try {

                $result = $db->query($sql);

                ConsoleColorize::print(
                    text: "table ". self::TABLE_NAME. " creating ",
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
                text: "table ". self::TABLE_NAME. " successfully created",
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