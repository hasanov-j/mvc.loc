<?php

declare(strict_types=1);

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
