<?php

declare(strict_types=1);

namespace App\Components;

class FileManager
{
    public static function upload(array $globalFileInfo, string $filename = null, string $path = UPLOAD_ROOT): string
    {
        $extention = pathinfo($globalFileInfo['name'], PATHINFO_EXTENSION);

        if (null === $filename) {
            $filename = uniqid();
        }

        if (move_uploaded_file($globalFileInfo['tmp_name'], $path. $filename. '.' .$extention)) {
            return "/upload/". $filename. '.' .$extention;
        }

        return throw new Exception('Something going wrong');
    }

    public static function remove(string $filename=null, string $path = ROOT): bool
    {
        $fullFilePath = $path.$filename;

        if (!file_exists($fullFilePath)) {
            throw new Exception('File not found', 500);
        }

        return unlink(filename: $fullFilePath);
    }
}
