<?php

declare(strict_types=1);

namespace App\Components;

class Redirect
{
    public static function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: {$referer}");
    }

    public static function main(): void
    {
        header("Location: /");
    }

    public static function orderAccess(): void
    {
        http_response_code(201);
        require_once VIEW_ROOT. 'shopping-cart/order-access.php';
    }

    public static function byStatusCode(int $statusCode): void
    {
        switch ($statusCode) {
            case 404:
                http_response_code(404); // Устанавливаем код ошибки 404

                require_once VIEW_ROOT.'error_pages/404.php';

                exit;

                break;

            case 403:
                http_response_code(403);
                require_once VIEW_ROOT.'error_pages/403.php';

                exit;

                break;

            default:
                http_response_code(500);

                require_once VIEW_ROOT.'error_pages/500.php';

                exit;
        }
    }
}
