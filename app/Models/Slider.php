<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class Slider
{
    public static function getAll($PDOMode = \PDO::FETCH_ASSOC): ?array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM sliders";
            $result = $db->query($sql);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }
        return $result->fetchAll($PDOMode);
    }

    public static function getOneByUuid(string $uuid, $PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {

            $db = Database::getConnection();
            $sql = "SELECT * FROM sliders WHERE uuid='{$uuid}'";
            $result = $db->query($sql);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );
        }

        return $result->fetch(mode: $PDOMode);
    }

    public static function checkDescription(string $description) : bool
    {
        return strlen($description) < 1000;
    }



    public static function add(
        string $url,
        string $description=null,
        string $uuid = null
    ): bool {
        try {
            $db=Database::getConnection();

            $sql="INSERT INTO sliders (
                uuid,
                url,
                description
            ) VALUES(
                :uuid,
                :url,
                :description
            )";

            if ($uuid==null){
                $uuid=Uuid::uuid4()->toString();
            }

            $result=$db->prepare($sql);

            $result->bindParam(":uuid", $uuid, \PDO::PARAM_STR);
            $result->bindParam(":url", $url, \PDO::PARAM_STR);
            $result->bindParam(":description", $description, \PDO::PARAM_STR);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            ); die;
        }

        return $result->execute();
    }

    public static function deleteByUuid(string $uuid)
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM sliders WHERE uuid= :uuid";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":uuid", $uuid, \PDO::PARAM_STR);
            $result->execute();

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            ); die;
        }

    }

}