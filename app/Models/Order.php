<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Exception\ModelException\ModelException;
use App\Exception\ModelException\ModelNotFoundException;
use App\Exception\SeedException\SeedInsertErrorException;
use Cassandra\Date;
use Ramsey\Uuid\Uuid;

class Order
{
    const TABLE_NAME="orders";

    const STATUS_PROCCESSED = 'оформлен';
    const STATUS_PENDING = 'в процессе';
    const STATUS_DONE = 'выполнен';
    const STATUS_PAIN = 'оплачен';
    const ORDER_STATUSES = [
        self::STATUS_PROCCESSED,
        self::STATUS_PENDING,
        self::STATUS_DONE,
        self::STATUS_PAIN,
    ];

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        $result = $db->query($sql);
        $orders = $result->fetchAll($Mode);


        return $orders;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";

        $result = $db->query($sql);
        $order = $result->fetch($Mode);

        if (!$order) {
            throw new ModelNotFoundException("Order with this uuid: {$uuid}  not found");
        }
        return $order;
    }

    public static function statusUpdate(
        string $statusOrder,
        string $uuid
    ): void {

        $db = Database::getConnection();

        $sql = "UPDATE " . self::TABLE_NAME . " SET ";

        match ($statusOrder) {
            self::STATUS_PROCCESSED => $sql .= self::STATUS_PROCCESSED,
            self::STATUS_PENDING => $sql .= self::STATUS_PENDING,
            self::STATUS_DONE => $sql .= self::STATUS_DONE,
            self::STATUS_PAIN => $sql .= self::STATUS_PAIN,
        };

        $sql .= " WHERE uuid=" . $uuid;
        $db->query($sql);
    }

    public static function create(
        int $idUsers,
        string $paymentType,
        float $price,
        string $orderStatus=self::STATUS_PROCCESSED,
        Date $createdAt=null,
        string $uuid=null
    ): void
    {

        if ($createdAt == null) {
            $createdAt = \date('Y-m-d H:i:s');
        }

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                                id_users,
                                created_at,
                                payment_type,
                                order_status,
                                price,
                                uuid
                                ) VALUES (
                                :id_users,
                                :created_at,
                                :payment_type,
                                :order_status,
                                :price,
                                :uuid
                                )";

        try {

            $result = $db->prepare($sql);
            $result->bindParam('id_users', $idUsers, \PDO::PARAM_INT);
            $result->bindParam('created_at', $createdAt);
            $result->bindParam('payment_type', $paymentType);
            $result->bindParam('order_status', $orderStatus);
            $result->bindParam('price', $price);
            $result->bindParam('uuid', $uuid);
            $result->execute();

        } catch (ModelException $exception) {
            throw new SeedInsertErrorException("Error when entering order with uuid: '{$uuid}'");
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
                text: "Order by uuid={$uuid} is deleting",
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
            text: "Order by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }

}