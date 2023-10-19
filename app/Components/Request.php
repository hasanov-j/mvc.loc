<?php

namespace App\Components;

class Request
{
    const CONTENT_TYPE_JSON = 'application/json';
    const CONTENT_TYPE_MULTIPART_FORM_DATA = 'multipart/form-data';

//    const AVAILABLE_REQUEST_CONTENT_TYPES = [
//        self::CONTENT_TYPE_JSON,
//        self::CONTENT_TYPE_MULTIPART_FORM_DATA,
//    ];

    public static function getContent() : array
    {

        if(self::getMethod() == 'GET'){

            foreach ($_GET as $key => $value){
                $_GET[$key] = match (true){
                    is_numeric($value) => (int) $value,
                    default => $value
                };
            }

            return $_GET;

        }else{

            if(in_array(self::CONTENT_TYPE_JSON, self::getContentTypes())){
                $rawData = file_get_contents('php://input');
                $arrayContent = json_decode($rawData, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception("Ошибка при декодировании JSON: " . json_last_error_msg());
                }

                return $arrayContent;
            }

            if(in_array(self::CONTENT_TYPE_MULTIPART_FORM_DATA, self::getContentTypes())){
                return $_POST;
            }
        }



        return [];
    }

    public static function getContentTypes() : array
    {
        $contentType = $_SERVER['CONTENT_TYPE'];

        return explode(';', $contentType);
    }

    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getClientIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
}