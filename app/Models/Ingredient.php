<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class Ingredient
{
    const TABLE_NAME = 'ingredients';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        try {

            $result = $db->query($sql);
            $ingredients = $result->fetchAll($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $ingredients;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";
        try {

            $result = $db->query($sql);
            $ingredient = $result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $ingredient;
    }

    public static function create(
        string $name,
        string $uuid = null,
    ): void {

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                            name,
                            uuid
                            ) VALUES (
                            :name,
                            :uuid
                            );";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":name", $name);
            $result->bindParam(":uuid", $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: 'ingredient adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        ConsoleColorize::print(
            text: 'ingredient added to table ' . self::TABLE_NAME,
            color: ConsoleColorize::GREEN
        );
    }

    public static function deleteByUuid(string $uuid): void
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE uuid= :uuid";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":uuid", $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: "ingredient by uuid={$uuid} is deleting",
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
            text: "ingredient by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}