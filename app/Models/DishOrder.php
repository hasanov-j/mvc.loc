<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Exception\ModelException\ModelException;
use App\Exception\ModelException\ModelInsertErrorException;
use App\Exception\ModelException\ModelNotFoundException;
use Ramsey\Uuid\Uuid;

class DishOrder
{
    const TABLE_NAME = 'dish_order';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        $result = $db->query($sql);
        $result = $result->fetchAll($Mode);

        return $result;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";

        $result = $db->query($sql);
        $result = $result->fetch($Mode);

        if (!$result) {
            throw new ModelNotFoundException("Row with this uuid: {$uuid} not found");
        }

        return $result;
    }

    public static function create(
        int $orderId,
        int $dishId,
        int $quantity,
        string $uuid = null,
    ): void {

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                              uuid,
                              order_id,
                              dish_id,
                              quantity
                              ) VALUES (
                              :uuid,
                              :order_id,
                              :dish_id,
                              :quantity
                              )";

        try {
            $result = $db->prepare($sql);
            $result->bindParam(':uuid', $uuid);
            $result->bindParam(':order_id', $orderId, \PDO::PARAM_INT);
            $result->bindParam(':dish_id', $dishId, \PDO::PARAM_INT);
            $result->bindParam(':quantity', $quantity, \PDO::PARAM_INT);
            $result->execute();
        } catch (ModelException $exception) {
            throw new ModelInsertErrorException(
                "Error, when entering this dish id:{$dishId} and order id:{$orderId} into the database"
            );
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
                text: "row by uuid={$uuid} is deleting",
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
            text: "row by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}