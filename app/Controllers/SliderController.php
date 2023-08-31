<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Components\FileManager;
use App\Components\Redirect;
use App\Components\Session;
use App\Models\Slider;

class SliderController
{
    public function index(): void
    {
        $imagesInfo = Slider::getAll();
        //var_dump($imagesInfo);die;
        include_once VIEW_ROOT . "slider/index.php";
    }

    public function store(): void
    {
        if (!empty($_FILES['image'])) {

            $url = FileManager::upload($_FILES['image'], filename: $_FILES['name']);

            $description = $_POST['description'];

            $errors=[];

            if (!Slider::checkDescription($description)) {
                $errors['description'] = "Комментарий превышает лимит символов";
            }

            if(empty($errors)){

                Slider::add(
                    url: $url,
                    description: $description,
                );

                Redirect::back();
            } else {
                Session::set(name: 'errors',value: $errors);
                Redirect::back();
            }


        }

    }

    public function destroy(string $uuid): void
    {
        $slideInfo = Slider::getOneByUuid($uuid);
        FileManager::remove($slideInfo['url']);
        Slider::deleteByUuid($uuid);
    }
}