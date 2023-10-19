<?php

declare(strict_types=1);

namespace App\Components;


class Response
{
    const RESPONSE_SUCCESS_TYPE = 'data';
    const RESPONSE_ERROR_TYPE = 'errors';


    public static function view(string $viewPath, array $data, int $status = 200)
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        http_response_code($status);

        if (file_exists(VIEW_ROOT . $viewPath)) {
            require_once VIEW_ROOT . $viewPath;
        } else {
            throw new \Exception("View file with name {$viewPath}  not fount in " . VIEW_ROOT);
        }
    }

    public static function json(?array $content = null, int $status= 200, string $type = self::RESPONSE_SUCCESS_TYPE, ?string $message = null):void
    {
        http_response_code($status);
        header('Content-Type: application/json');

        $response = [];

        if($message){
            $response['message'] = $message;
        }

        if($content){
            $response[$type] = $content;
        }


        echo json_encode($response,JSON_THROW_ON_ERROR);
    }
}