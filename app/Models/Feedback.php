<?php

declare(strict_types=1);

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;

class Feedback
{
    public static function getAll($PDOMode = \PDO::FETCH_ASSOC): array
    {
        try {

            $db = Database::getConnection();
            $sql = "SELECT * FROM feedbacks";
            $result = $db->query($sql);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );
        }

        return $result->fetchAll($PDOMode);
    }

    public static function checkFirstname(string $firstname): bool
    {
        $pattern = "/^([A-Za-z]+)$/";
        if (preg_match(pattern: $pattern, subject: $firstname)) {

            return true;

        }

        return false;
    }

    public static function checkLastname(string $lastname): bool
    {
        $pattern = "/^([A-Za-z]+)$/";
        if (preg_match(pattern: $pattern, subject: $lastname)) {

            return true;

        }

        return false;
    }

    public static function checkPhone(string $phone): bool
    {
        $pattern = "/^\+375-\d{2}-\d{3}-\d{2}-\d{2}$/";
        if (preg_match(pattern: $pattern, subject: $phone)) {

            return true;

        }

        return false;
    }

    public static function checkEmail(string $email): bool
    {
        $pattern = "/^[a-z_\.\-]{5,31}@[a-z]{2,8}\.[a-z]{2,4}$/";
        if (preg_match(pattern: $pattern, subject: $email)) {

            return true;

        }

        return false;
    }

    public static function checkComment(string $comment) : bool
    {
        return strlen($comment) < 1000 && strlen($comment) > 0;
    }

    public static function add(
        string $firstname,
        string $email,
        string $comment,
        string $lastname = null,
        string $phone = null,
    ): bool {

        try {
            $db = Database::getConnection();

            $sql = "INSERT INTO feedbacks (
                firstname,
                lastname,
                phone,
                email,
                comment     
            ) VALUES(
                :firstname,
                :lastname,
                :phone,
                :email,
                :comment    
            )";

            $result = $db->prepare($sql);

            $result->bindParam(":firstname", $firstname);
            $result->bindParam(":lastname", $lastname,);
            $result->bindParam(":phone", $phone);
            $result->bindParam(":email", $email);
            $result->bindParam(":comment", $comment);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: sprintf("Something going wrong: %s", $e->getMessage()),
                color: ConsoleColorize::RED
            );
            die;
        }

        return $result->execute();
    }
}