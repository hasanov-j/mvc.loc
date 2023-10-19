<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class Feedback
{
    const TABLE_NAME = 'feedbacks';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        try {

            $result = $db->query($sql);
            $feedbacks = $result->fetchAll($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $feedbacks;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";
        try {

            $result = $db->query($sql);
            $feedback = $result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $feedback;
    }

    public static function create(
        string $firstname,
        string $lastname,
        string $phone,
        string $comment,
        ?int $id_users=null,
        string $uuid = null,
    ): void {

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $currentTime=date("Y-m-d H:i:s");

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                            id_users,
                            firstname,
                            lastname,
                            phone,
                            comment,
                            time_at,
                            uuid
                            ) VALUES (
                            :id_users,
                            :firstname,
                            :lastname,
                            :phone,
                            :comment,
                            :time_at,
                            :uuid
                            );";

        $result = $db->prepare($sql);
        $result->bindParam(":id_users", $id_users);
        $result->bindParam(":firstname", $firstname);
        $result->bindParam(":lastname", $lastname);
        $result->bindParam(":comment", $comment);
        $result->bindParam(":phone", $phone);
        $result->bindParam(":time_at", $currentTime);
        $result->bindParam(":uuid", $uuid);
        $result->execute();

    }

    public static function deleteByUuid(string $uuid): void
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE uuid= :uuid";

            $result = $db->prepare($sql);
            $result->bindParam(":uuid", $uuid);
            $result->execute();

    }
}