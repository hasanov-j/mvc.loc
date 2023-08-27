<?php

declare(strict_types=1);

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class User
{
    public static function getAllUsers($PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM users";
            $result = $db->query($sql);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }
        return $result->fetchAll($PDOMode);
    }

    public static function getBYId(int $id, $PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM users WHERE id=" . $id;
            $result = $db->query($sql);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );
        }

        return $result->fetch($PDOMode);
    }

    public static function getByFirstname(string $firstname, $PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM users WHERE firstname=" . $firstname;
            $result = $db->query($sql);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }

        return $result->fetch($PDOMode);
    }

    public static function getByLastname(string $lastName, $PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM users WHERE lastname=" . $lastName;
            $result = $db->query($sql);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }

        return $result->fetch($PDOMode);
    }

    public static function getByPhone(string $phone, $PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM users WHERE lastname=" . $phone;
            $result = $db->query($sql);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }
        return $result->fetch($PDOMode);
    }

    public static function getByCountry(string $country, $PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM users WHERE lastname=" . $country;
            $result = $db->query($sql);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }

        return $result->fetch($PDOMode);
    }

    public static function getByCity(string $city, $PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM users WHERE lastname=" . $city;
            $result = $db->query($sql);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }
        return $result->fetch($PDOMode);
    }


    public static function create(
        string $firstname,
        string $lastname,
        int $age,
        string $phone,
        string $country,
        string $city,
        string $uuid = null,
    ): bool {

        try {
            $db = Database::getConnection();

            $sql = "INSERT INTO users (
                  firstname,
                  lastname,
                  age,
                  phone,
                  country,
                  city,
                  uuid
              ) VALUES(
                   :firstname,
                   :lastname,
                   :age,
                   :phone,
                   :country,
                   :city,
                   :uuid
        )";

            if ($uuid == null) {
                $uuid = Uuid::uuid4()->toString();
            }

            $result = $db->prepare($sql);

            $result->bindParam(":firstname", $firstname, \PDO::PARAM_STR);
            $result->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
            $result->bindParam(":age", $age, \PDO::PARAM_INT);
            $result->bindParam(":phone", $phone, \PDO::PARAM_STR);
            $result->bindParam(":country", $country, \PDO::PARAM_STR);
            $result->bindParam(":city", $city, \PDO::PARAM_STR);
            $result->bindParam(":uuid", $uuid, \PDO::PARAM_STR);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }
        return $result->execute();
    }

    public static function deleteByUuid(string $uuid)
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM users WHERE uuid= :uuid";

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