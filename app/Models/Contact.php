<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class Contact
{
    const TABLE_NAME = 'contacts';

    public static function getAll(
        $Mode = \PDO::FETCH_ASSOC
    ): array
    {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;
        try {

            $result = $db->query($sql);
            $contacts=$result->fetchAll($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $contacts;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";
        try {

            $result = $db->query($sql);
            $contact = $result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $contact;
    }

    public static function create(

        string $location,
        string $phone,
        string $email,
        string $uuid=null,
    ): void
    {
        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                                location,
                                phone,
                                email,
                                uuid
                                ) 
                                VALUES (
                                :location,
                                :phone,
                                :email,
                                :uuid
                                  )";

        try {
            $result = $db->prepare($sql);
            $result->bindParam(":location", $location);
            $result->bindParam(":phone", $phone);
            $result->bindParam(":email", $email);
            $result->bindParam(":uuid", $uuid);
            $result->execute();

            ConsoleColorize::print(
                text: 'contact adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );
        } catch (\PDOException $e) {
            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );
        }

        ConsoleColorize::print(
            text: 'contact added to table ' . self::TABLE_NAME,
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
                text: "contact by uuid={$uuid} is deleting",
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
            text: "contact by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}