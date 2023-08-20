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

class UploadController
{
    public function show(): void
    {
        require VIEW_ROOT.'upload.php';
    }

    public function save(): void
    {
        FileManager::upload($_FILES['test']);
        Redirect::back();
    }

    public function showRemoveForm(): void
    {
        require VIEW_ROOT.'remove.php';
    }

    public function remove(): void
    {
        FileManager::remove(filename: $_POST['filename']);
        Redirect::back();
    }
}
