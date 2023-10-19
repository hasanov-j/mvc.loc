<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use Ramsey\Uuid\Uuid;

class DishIngredient
{
    const TABLE_NAME = 'dish_ingredient';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

            $result = $db->query($sql);
            $allDishIngredient = $result->fetchAll($Mode);


        return $allDishIngredient;
    }

    public static function getIngredientDishByDishesId(
        int $idDishes,
        $Mode = \PDO::FETCH_ASSOC
    ):array {
        $db = Database::getConnection();
        $sql = "SELECT * FROM ". self::TABLE_NAME . " WHERE id_dishes='{$idDishes}'";
        $result=$db->query($sql);
        $ingredientDish=$result->fetchAll($Mode);
        return $ingredientDish;
    }

    public static function create(
        int $idIngredients,
        int $idDishes,
    ): void {

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                            id_ingredients,
                            id_dishes
                            ) VALUES (
                            :id_ingredients,
                            :id_dishes
                            );";

            $result = $db->prepare($sql);
            $result->bindParam(":id_ingredients", $idIngredients);
            $result->bindParam(":id_dishes", $idDishes);
            $result->execute();
    }

    public static function deleteByDishesId(int $idDishes): void
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id_dishes= :id_dishes";

        try {

            $result = $db->prepare($sql);
            $result->bindParam(":id_dishes", $idDishes);
            $result->execute();

            ConsoleColorize::print(
                text: "ingredient and dish by uuid={$idDishes} is deleting",
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
            text: "ingredient and dish by uuid={$idDishes} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }

}