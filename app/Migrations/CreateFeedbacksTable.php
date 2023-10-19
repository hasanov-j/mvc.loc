<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateFeedbacksTable
{
    const TABLE_NAME='feedbacks';
    public static function up(): void
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
                            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                            uuid VARCHAR(255) UNIQUE,
                            id_users INT UNSIGNED,
                            FOREIGN KEY (id_users) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
                            firstname VARCHAR(40),                             
                            lastname VARCHAR(40),  
                            phone VARCHAR(25),                           
                            comment TEXT,
                            time_at DATETIME
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