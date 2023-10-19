<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Exception\ModelException\ModelInsertErrorException;
use App\Exception\ModelException\ModelNotFoundException;
use Ramsey\Uuid\Uuid;

class Dish
{
    const TABLE_NAME = 'dishes';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        $result = $db->query($sql);
        $dishes = $result->fetchAll($Mode);

        return $dishes;
    }

    public static function getAllWithIngredients(
        ?int $categoryId=null,
        $searchTerm=null,
        string $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT
             d.id AS dish_id,
             d.uuid AS dish_uuid,
             d.name AS dish_name,
             d.cost AS dish_cost,
             d.url AS dish_url,
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'ingredient_id', i.id,
                        'ingredient_uuid', i.uuid,
                        'ingredient_name',i.name
                     )
                ) AS ingredients
             FROM
              dishes d
             LEFT JOIN 
                dish_ingredient di ON d.id = di.id_dishes
             LEFT JOIN 
                ingredients i ON di.id_ingredients = i.id";

        $sql .= $categoryId != null ? " WHERE d.id_categories = '{$categoryId}' " : " ";

        if($searchTerm != null){
            $sql .= "WHERE LOWER(d.name) LIKE LOWER('%{$searchTerm}%')" .
                    "OR LOWER(d.search_synonyms) LIKE LOWER('%{$searchTerm}%') ";
        }

        $sql .= "GROUP BY d.id, d.uuid, d.name, d.cost, d.url;";

        $result = $db->query($sql);

        $result = $result->fetchAll($Mode);

        if(empty($result)){
            throw new ModelNotFoundException('Not Found', 404);
        }


        array_walk($result, function (&$item) {
            $item['ingredients'] = json_decode($item['ingredients'], true);
        });

        return $result;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";

        $result = $db->query($sql);
        $dish = $result->fetch($Mode);

        return $dish;
    }

    public static function create(
        int $id_categories,
        string $name,
        int $cost,
        string $url,
        string $searchSynonyms,
        string $uuid = null,
    ): void {

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                            id_categories,
                            name,
                            cost,
                            url,
                            uuid,
                            search_synonyms
                            ) VALUES (
                            :id_categories,
                            :name,
                            :cost,
                            :url,
                            :uuid,
                            :search_synonyms
                            );";

        try {
            $result = $db->prepare($sql);
            $result->bindParam(":id_categories", $id_categories);
            $result->bindParam(":name", $name);
            $result->bindParam(":cost", $cost);
            $result->bindParam(":url", $url);
            $result->bindParam(":uuid", $uuid);
            $result->bindParam(":search_synonyms", $searchSynonyms);
            $result->execute();
        } catch (\PDOException $exception){
            throw new ModelInsertErrorException("Error when entering this dish: '{$name}' into the database");
        }

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
                text: "dish by uuid={$uuid} is deleting",
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
            text: "dish by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }

}