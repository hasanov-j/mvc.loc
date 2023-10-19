<?php

namespace App\Models;

use App\Components\ConsoleColorize;
use App\Components\Database;
use App\Exception\ModelException\ModelNotFoundException;
use Ramsey\Uuid\Uuid;

class User
{
    const TABLE_NAME = 'users';

    public static function getALL(
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME;

        $result = $db->query($sql);
        $users = $result->fetchAll($Mode);

        return $users;
    }

    public static function getOneByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";

        $result = $db->query($sql);
        $user = $result->fetch($Mode);

        if (!$user) {
            throw new ModelNotFoundException("User with this uuid: {$uuid} not found");
        }

        return $user;
    }

    public static function getOneByEmail(
        string $email,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE email='{$email}'";

        $result = $db->query($sql);
        $user = $result->fetch($Mode);

        if (!$user) {
            throw new ModelNotFoundException("User with this email: {$email} not found");
        }

        return $user;
    }

    public static function isUserWithEmailExists(
        string $email,
        $Mode = \PDO::FETCH_ASSOC
    ): bool {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE email='{$email}'";

        $result = $db->query($sql);
        $user = $result->fetch($Mode);

        if (!$user) {
            return false;
        }

        return true;
    }

    public static function getOneByPhone(
        string $phone,
        $Mode = \PDO::FETCH_ASSOC
    ): array {
        $db = Database::getConnection();

        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE phone='{$phone}'";

        $result = $db->query($sql);
        $user = $result->fetch($Mode);

        if (!$user) {
            throw new ModelNotFoundException("User with this phone: {$phone} not found");
        }

        return $user;
    }

    public static function findIdByUuid(
        string $uuid,
        $Mode = \PDO::FETCH_ASSOC
    ): int {
        $db = Database::getConnection();

        $sql = "SELECT id FROM " . self::TABLE_NAME . " WHERE uuid='{$uuid}'";

        $result = $db->query($sql);
        $user = $result->fetch($Mode);

        if (!$user) {
            throw new ModelNotFoundException("Id with this uuid: {$uuid} not found");
        }

        return $user['id'];
    }

    public static function getOneWithSessionUuid(
        string $sessionUuid,
        $Mode = \PDO::FETCH_ASSOC
    ):array{
        $db = Database::getConnection();
        $sql="SELECT 
                users.id, 
                users.uuid,
                users.firstname,
                users.lastname,
                users.phone,
                users.email,
                users.avatar 
              FROM " . self::TABLE_NAME . " " .
             "INNER JOIN sessions_managers ON users.id=sessions_managers.id_users 
              WHERE sessions_managers.session_uuid='{$sessionUuid}';";

        $result=$db->query($sql);
        $user=$result->fetch($Mode);
        if (!$user) {
            throw new ModelNotFoundException("User with this session uuid: {$sessionUuid}  not found");
        }
        return $user;

    }

    public static function create(
        string $firstname,
        string $lastname,
        string $phone,
        string $email,
        string $password,
        string $avatar,
        string $uuid = null,
    ): void {

        if ($uuid == null) {
            $uuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                            firstname,
                            lastname,
                            phone,
                            email,
                            password,
                            avatar,
                            uuid
                            ) VALUES (
                            :firstname,
                            :lastname,
                            :phone,
                            :email,
                            :password,
                            :avatar,
                            :uuid
                            );";

        $result = $db->prepare($sql);
        $result->bindParam(":firstname", $firstname);
        $result->bindParam(":lastname", $lastname);
        $result->bindParam(":phone", $phone);
        $result->bindParam(":email", $email);
        $result->bindParam(":password", $password);
        $result->bindParam(":avatar", $avatar);
        $result->bindParam(":uuid", $uuid);
        $result->execute();
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
                text: "user by uuid={$uuid} is deleting",
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
            text: "user by uuid={$uuid} successfully deleted",
            color: ConsoleColorize::GREEN
        );
    }
}