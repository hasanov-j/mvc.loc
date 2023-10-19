<?php

namespace App\Migrations;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Components\Migration;

class CreateSessionsManagersTable
{
    const TABLE_NAME='sessions_managers';
    public static function up(): void
    {
        $db=Database::getConnection();

        $sql="CREATE TABLE ". self::TABLE_NAME. " (
              id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
              id_users INT UNSIGNED,
              FOREIGN KEY (id_users) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
              session_uuid VARCHAR(255),
              is_active BOOLEAN DEFAULT 1,
              is_admin BOOLEAN DEFAULT 0,
              created_at DATE,
              destroy_at DATE,
              client_ip_address VARCHAR(50)
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