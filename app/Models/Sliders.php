<?php

namespace App\Models;


use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Seed\SeedInterface;
use Ramsey\Uuid\Uuid;

class Sliders
{
    const TABLE_NAME='sliders';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        try {

            $result = $db->query($sql);
            $sliders = $result->fetchAll($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $sliders;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";
        try {

            $result = $db->query($sql);
            $slider = $result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $slider;
    }

    public static function create(
        string $name,
        string $description,
        string $className,
        string $linkName,
        string $link,
        string $uuid = null,
    ): void {

        $db=Database::getConnection();

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $sql="INSERT INTO ". self::TABLE_NAME. " (
                           name,
                           description,
                           class_name,
                           link_name,
                           link,
                           uuid
                            ) VALUES (
                            :name,
                            :description,
                            :class_name,
                            :link_name,
                            :link,
                            :uuid
                            )";

        try {
            $result=$db->prepare($sql);
            $result->bindParam(':name', $name);
            $result->bindParam(':description', $description);
            $result->bindParam(':class_name', $className);
            $result->bindParam(':link_name', $linkName);
            $result->bindParam(':link', $link);
            $result->bindParam(':uuid', $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: 'slider adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );

        }  catch (\PDOException $e) {

            ConsoleColorize::print(
            text: $e->getMessage(),
            color: ConsoleColorize::RED
            );

        }

        ConsoleColorize::print(
            text: 'slider added to table ' . self::TABLE_NAME,
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
                text: "slider by uuid='{$uuid}' is deleting",
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
            text: "slider by uuid='{$uuid}' successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}