<?php

declare(strict_types=1);

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;

class User
{
    public static function getAllUsers(): array
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
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getBYId(int $id): array
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

        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getByFirstname(string $firstname): array
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

        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getByLastname(string $lastName): array
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

        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getByPhone(string $phone): array
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
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getByCountry(string $country): array
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

        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getByCity(string $city): array
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
        return $result->fetch(\PDO::FETCH_ASSOC);
    }


    public static function create(
        string $firstname,
        string $lastname,
        int $age,
        string $phone,
        string $country,
        string $city
    ): bool {
        try {
            $db = Database::getConnection();

            $sql = "INSERT INTO users (
                  firstname,
                  lastname,
                  age,
                  phone,
                  country,
                  city
              ) VALUES(
                   :firstname,
                   :lastname,
                   :age,
                   :phone,
                   :country,
                   :city
        )";

            $result = $db->prepare($sql);

            $result->bindParam(":firstname", $firstname, \PDO::PARAM_STR);
            $result->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
            $result->bindParam(":age", $age, \PDO::PARAM_INT);
            $result->bindParam(":phone", $phone, \PDO::PARAM_STR);
            $result->bindParam(":country", $country, \PDO::PARAM_STR);
            $result->bindParam(":city", $city, \PDO::PARAM_STR);
        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );

        }
        return $result->execute();
    }


}