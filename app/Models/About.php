<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;

class About
{
    const TABLE_NAME = 'about';

    public static function getInfo(
        $Mode = \PDO::FETCH_ASSOC
    ): array
    {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;
        try {

            $result = $db->query($sql);
            $about=$result->fetch($Mode);

        } catch (\PDOException $e) {

            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            );

        }

        return $about;
    }

    public static function create(
        string $title,
        string $description,
        string $imageUrl
    ): void
    {

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                                title,
                                description,
                                image_url
                                ) 
                                VALUES (
                                :title,
                                :description,
                                :image_url
                                  )";

        try {
            $result = $db->prepare($sql);
            $result->bindParam(":title", $title);
            $result->bindParam(":description", $description);
            $result->bindParam(":image_url", $imageUrl);
            $result->execute();

            ConsoleColorize::print(
                text: 'info about adding to table ' . self::TABLE_NAME,
                color: ConsoleColorize::BLUE
            );
        } catch (\PDOException $e) {
            ConsoleColorize::print(
                text: $e->getMessage(),
                color: ConsoleColorize::RED
            ); die;
        }

        ConsoleColorize::print(
            text: 'info about added to table ' . self::TABLE_NAME,
            color: ConsoleColorize::GREEN
        );

    }

    public static function deleteByTitle(
        string $title
    ): void
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE title= :title";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":title", $title);
            $result->execute();

            ConsoleColorize::print(
                text: "info about with title={$title} is deleting",
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
            text: "info about with title={$title} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}