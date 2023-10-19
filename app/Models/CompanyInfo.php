<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;

class CompanyInfo
{
    const TABLE_NAME = 'company_info';

    public static function getInfo(
        $Mode = \PDO::FETCH_ASSOC
    ): array
    {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;
        try {

            $result = $db->query($sql);
            $info=$result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $info;
    }

    public static function create(
        string $description,
        string $name,
        string $days,
        string $time
    ): void
    {

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                                description,
                                name,
                                days,
                                time
                                ) 
                                VALUES (
                                :description,
                                :name,
                                :days,
                                :time
                                  )";

        try {
            $result = $db->prepare($sql);
            $result->bindParam(":description", $description);
            $result->bindParam(":name", $name);
            $result->bindParam(":days", $days);
            $result->bindParam(":time", $time);
            $result->execute();

            ConsoleColorize::print(
                text: 'info adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );
        } catch (\PDOException $e) {
            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );
        }

        ConsoleColorize::print(
            text: 'info added to table ' . self::TABLE_NAME,
            color: ConsoleColorize::GREEN
        );

    }

    public static function deleteByName(
        string $name
    ): void
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE name=:name";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":name", $name);
            $result->execute();

            ConsoleColorize::print(
                text: "info by name={$name} is deleting",
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
            text: "info by name={$name} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }

}