<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class SocialNetworks
{
    const TABLE_NAME = 'social_networks';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        try {

            $result = $db->query($sql);
            $socialNetworks = $result->fetchAll($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $socialNetworks;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";
        try {

            $result = $db->query($sql);
            $socialNetwork = $result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $socialNetwork;
    }

    public static function create(
        string $className,
        string $link,
        string $uuid = null,
    ): void {

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                            class_name,
                            link,
                            uuid
                            ) VALUES (
                            :class_name,
                            :link,
                            :uuid
                            );";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":class_name", $className);
            $result->bindParam(":link", $link);
            $result->bindParam(":uuid", $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: 'social network adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        ConsoleColorize::print(
            text: 'social network added to table ' . self::TABLE_NAME,
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
                text: "social network by uuid={$uuid} is deleting",
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
            text: "social network by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}