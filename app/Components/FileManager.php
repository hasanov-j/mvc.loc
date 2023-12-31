<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Components;

class FileManager
{
    public static function upload(array $globalFileInfo, string $filename = null, string $path = UPLOAD_ROOT): bool
    {
        $extention = pathinfo($globalFileInfo['name'], PATHINFO_EXTENSION);

        if (null === $filename) {
            $filename = uniqid();
        }

        if (move_uploaded_file($globalFileInfo['tmp_name'], $path.$filename.'.'.$extention)) {
            return true;
        }

        return throw new Exception('Something going wrong');
    }

    public static function remove(string $filename, string $path = UPLOAD_ROOT): bool
    {
        $fullFilePath = $path.$filename;

        if (!file_exists($fullFilePath)) {
            throw new Exception('File not found', 500);
        }

        return unlink(filename: $fullFilePath);
    }
}
