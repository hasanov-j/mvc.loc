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

namespace App\Controller;

class UsersController
{
    public function list(): void
    {
        echo 'Сообщение с контроллера!'.PHP_EOL.__METHOD__;
    }

    public function getname(): void
    {
        echo 'Сообщение с контроллера!'.PHP_EOL.__METHOD__;
    }
}
