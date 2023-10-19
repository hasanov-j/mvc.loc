<?php

namespace App\Models;

use App\Components\Database;
use App\DTO\SessionManager\SessionManagerDTO;
use App\Exception\ModelException\ModelNotFoundException;
use Ramsey\Uuid\Uuid;

class SessionManager
{
    const TABLE_NAME = "sessions_managers";

    public static function getAll(
        $Mode = \PDO::FETCH_ASSOC
    ): array {

        $db = Database::getConnection();
        $sql = "SELECT * FROM " . self::TABLE_NAME;
        $result = $db->query($sql);
        return $result->fetchAll($Mode);
    }


    public static function findOneByUuid(
        string $sessionUuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {

        $db = Database::getConnection();
        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE session_uuid='{$sessionUuid}'";
        $result = $db->query($sql);

        $result = $result->fetch($Mode);

        if (!$result) {
            throw new ModelNotFoundException("Session with this session {$sessionUuid} uuid not found");
        }

        return $result;
    }

    public static function getOneByUuid(
        string $sessionUuid,
        $Mode = \PDO::FETCH_ASSOC
    ): array {

        $db = Database::getConnection();
        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE session_uuid='{$sessionUuid}'";
        $result = $db->query($sql);

        $result = $result->fetch($Mode);

        if (!$result) {
            throw new ModelNotFoundException("Session with this session {$sessionUuid} uuid not found");
        }

        return $result;
    }

    public static function create(
        int $idUsers,
        string $ip,
        ?string $sessionUuid = null,
        bool $isAdmin = false
    ): void {

        $createdAt = date('Y-m-d H:i:s');

        if ($sessionUuid == null) {
            $sessionUuid = Uuid::uuid4()->toString();
        }

        $db = Database::getConnection();

        $sql = "INSERT INTO " . self::TABLE_NAME . " (
                          id_users,
                          session_uuid,
                          is_admin,
                          created_at,
                          client_ip_address
                          ) VALUES (
                          :id_users,
                          :session_uuid,
                          :is_admin,
                          :created_at,
                          :client_ip_address
                          );";

        $result = $db->prepare($sql);

        $result->bindParam(param: ":id_users", var: $idUsers, type: \PDO::PARAM_INT);
        $result->bindParam(param: ":session_uuid", var: $sessionUuid);
        $result->bindParam(param: ":is_admin", var: $isAdmin, type: \PDO::PARAM_BOOL);
        $result->bindParam(param: ":created_at", var: $createdAt);
        $result->bindParam(param: ":client_ip_address", var: $ip);

        $result->execute();
    }

    public static function destroy(string $session_uuid): bool
    {
        $db = Database::getConnection();

        $destroyAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . self::TABLE_NAME . " ".
            "SET " .
            "is_active=0, " .
            "destroy_at='{$destroyAt}' " .
            "WHERE session_uuid='{$session_uuid}'";

        $db->query($sql);

        return true;
    }

    public static function deleteByUuid(
        string $sessionUuid
    ): void {
        $db = Database::getConnection();

        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE session_uuid= :uuid";

        $result = $db->prepare($sql);
        $result->bindParam(":uuid", $sessionUuid);
        $result->execute();
    }


    public static function findFirstActiveByClientIp(int $userId, string $clientIpAddress)
    {
        $db = Database::getConnection();
        $sql = "SELECT * FROM " . self::TABLE_NAME .
                " WHERE id_users='{$userId}' AND client_ip_address='{$clientIpAddress}' AND is_active=1";
        $result = $db->query($sql);
        $result = $result->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}