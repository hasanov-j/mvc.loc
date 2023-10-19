<?php

declare(strict_types=1);

namespace App\Controllers\Frontent\Api;

use App\Components\Request;
use App\Components\Response;
use App\Models\Feedback;
use Ramsey\Uuid\Uuid;

class FeedbackApiController
{
    public function index()
    {
        Response::json(Feedback::getALL());
    }

    public function store(): void
    {
        $requestData = Request::getContent();

        $errors = [];

        $comment = $requestData['comment'];


        if (!preg_match("/^[A-Za-z]+$/", $requestData['firstname'] ?? "")) {
            $errors['firstname'] = "Неверно введено имя пользователя, пожалуйста, повторите попытку";
        };

        if (!preg_match("/^[A-Za-z]+$/", $requestData['lastname'] ?? "")) {
            $errors['lastname'] = "Неверно введена фамилия пользователя, пожалуйста, повторите попытку";
        };

        if (!preg_match("/^\+375[0-9]{9}$/", $requestData['phone'] ?? "")) {
            $errors['phone'] = "Неверно введен номер телефона, пожалуйста, повторите попытку";
        };

        if (!preg_match("/^.{1,1000}$/s", $requestData['comment'] ?? "")) {
            $errors['comment'] = "Запрещено вводить более 1000 символов, пожалуйста, повторите попытку";
        };

        if ($errors == null) {

            $uuid = Uuid::uuid4()->toString();

           Feedback::create(
               firstname: $requestData['firstname'],
               lastname: $requestData['lastname'],
               phone: $requestData['phone'],
               comment: $requestData['comment'],
               uuid: $uuid
            );

            Response::json(
                status: 201,
                message: "Данные успешно сохраннены"
            );

        } else {

            Response::json(
                content: $errors,
                status: 422,
                type: Response::RESPONSE_ERROR_TYPE,
                message: "Валидация данных не прошла"
            );
        }
    }
}