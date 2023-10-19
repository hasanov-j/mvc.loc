<?php

declare(strict_types=1);

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class Category
{
    const TABLE_NAME = 'categories';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array
    {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        try {

            $result = $db->query($sql);
            $categories=$result->fetchAll($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $categories;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array
    {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";
        try {

            $result = $db->query($sql);
            $category=$result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $category;
    }

    public static function create(
        string $name,
        string $uuid = null
    ): void
    {

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (uuid,name) VALUES (:uuid, :name)";

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        try {
            $result = $db->prepare($sql);
            $result->bindParam(":name", $name);
            $result->bindParam(":uuid", $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: 'category adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );
        } catch (\PDOException $e) {
            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );
        }

        ConsoleColorize::print(
            text: 'category added to table ' . self::TABLE_NAME,
            color: ConsoleColorize::GREEN
        );

    }

    public static function deleteByUuid(
        string $uuid
    ): void
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE uuid= :uuid";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":uuid", $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: "category by uuid={$uuid} is deleting",
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
            text: "category by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }

}