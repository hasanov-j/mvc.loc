<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Exception\ModelException\ModelInsertErrorException;
use App\Exception\ModelException\ModelNotFoundException;

class Promocode
{
    const TABLE_NAME = 'promocodes';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        $result = $db->query($sql);
        $promotions = $result->fetchAll($Mode);

        return $promotions;
    }

    public static function getOneByValue(
        string $value,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE `value`='{$value}'";

        $result = $db->query($sql);
        $promocode = $result->fetch($Mode);

        if(!$promocode){
            throw new ModelNotFoundException("Promocode with this: '{$value}' value not found");
        }

        return $promocode;
    }

    public static function create(
        string $title,
        string $description,
        string $url_img,
        int $discount,
        string $value,
        string $is_advertising
    ): void {

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                            title,
                            description,
                            url_img,
                            discount,
                            value,
                            is_advertising
                            ) VALUES (
                            :title,
                            :description,
                            :url_img,
                            :discount,
                            :value,
                            :is_advertising
                            );";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":title", $title);
            $result->bindParam(":description", $description);
            $result->bindParam(":url_img", $url_img);
            $result->bindParam(":discount", $discount,\PDO::PARAM_INT);
            $result->bindParam(":value", $value);
            $result->bindParam(":is_advertising", $is_advertising,\PDO::PARAM_BOOL);
            $result->execute();

        } catch (\PDOException $e) {
            throw new ModelInsertErrorException("Error when entering promocode with value: '{$value}'");
        }
    }

    public static function deleteByValue(string $value): void
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE value= :value";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":value", $value);
            $result->execute();

            ConsoleColorize::print(
                text: "promocode with value={$value} is deleting",
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
            text: "promocode with value={$value} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}