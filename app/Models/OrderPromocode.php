<?php

namespace App\Models;

use App\Components\Database;
use App\Exception\ModelException\ModelException;
use App\Exception\ModelException\ModelInsertErrorException;
use App\Exception\ModelException\ModelNotFoundException;
use App\Exception\SeedException\SeedInsertErrorException;
use Cassandra\Date;
use Ramsey\Uuid\Uuid;

class OrderPromocode
{
    const TABLE_NAME='order_promocode';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        $result = $db->query($sql);
        $table = $result->fetchAll($Mode);


        return $table;
    }

    public static function create(
        int $orderId,
        int $promocodeId,
    ): void
    {

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                                order_id,
                                promocode_id
                                ) VALUES (
                                :order_id,
                                :promocode_id
                                )";

        try {

            $result = $db->prepare($sql);
            $result->bindParam('order_id', $orderId, \PDO::PARAM_INT);
            $result->bindParam('promocode_id', $promocodeId, \PDO::PARAM_INT);
            $result->execute();

        } catch (ModelException $exception) {
            throw new ModelInsertErrorException("Error when entering order and promocode id");
        }
    }

}