<?php

namespace App\Controllers;

use App\Components\Redirect;
use App\Components\Session;
use App\Models\Feedback;
use App\Models\Slider;

class FeedbackController
{
    public function index()
    {
        $images = Slider::getAll();
        $comments = Feedback::getAll();

        include_once VIEW_ROOT . "feedback/index.php";
    }

    public function store()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $phone = $_POST['phone'];

        //создаем массив для сбора ошибок
        $errors = [];

        if (!Feedback::checkFirstname($firstname)) {
            $errors['firstname'] = "Имя введено некорректно";
        }

        if (!Feedback::checkLastname($lastname)) {
            $errors['lastname'] = "Фамилия введена некорректно";
        }

        if (!Feedback::checkEmail($email)) {
            $errors['email'] = "адрес электронной почты введен некорректно";
        }

        if (!Feedback::checkComment($comment)) {
            $errors['comment'] = "Комментарий превышает лимит символов";
        }

        if (!Feedback::checkPhone($phone)) {
            $errors['phone'] = "Номер телефона введен некорректно";
        }

        if (empty($errors)) {
            Feedback::add(
                firstname: $firstname,
                email: $email,
                comment: $comment,
                lastname: $lastname,
                phone: $phone
            );

            Redirect::back();

        } else {

            Session::set(
                name: "errors",
                value: $errors
            );

            Redirect::back();

        }

    }
}
