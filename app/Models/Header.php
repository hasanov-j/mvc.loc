<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class Header
{
    const TABLE_NAME='headers';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        try {

            $result = $db->query($sql);
            $headers = $result->fetchAll($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $headers;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";
        try {

            $result = $db->query($sql);
            $header = $result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $header;
    }

    public static function create(
        string $name,
        string $url,
        string $uuid = null,
    ): void {

        $db=Database::getConnection();

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $sql="INSERT INTO ". self::TABLE_NAME. " (
                           name,
                           url,
                           uuid
                            ) VALUES (
                            :name,
                            :url,
                            :uuid
                            )";

        try {
            $result=$db->prepare($sql);
            $result->bindParam(':name', $name);
            $result->bindParam(':url', $url);
            $result->bindParam(':uuid', $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: 'header adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );

        }  catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        ConsoleColorize::print(
            text: 'header added to table ' . self::TABLE_NAME,
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
                text: "header by uuid='{$uuid}' is deleting",
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
            text: "header by uuid='{$uuid}' successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}