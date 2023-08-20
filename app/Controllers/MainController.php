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

namespace App\Controllers;

class MainController
{
    public function index(): void
    {
        // Создание архива
        $phar = new Phar('my.phar');

        // Добавление файла в архив
        $phar['hello.txt'] = 'Hello World';

        // Получение файла из архива
        echo file_get_contents('phar://my.phar/hello.txt');
    }
}
