<?php

namespace App\Controllers\Frontent\Api;

use App\Components\Request;
use App\Components\Response;
use App\Exception\ModelException\ModelNotFoundException;
use App\Models\Promocode;

class PromocodeApiController
{
    public function store(): void
    {

        $requestData=Request::getContent()['data'];

        $promocode=null;

        try {
            $promocode=Promocode::getOneByValue($requestData['promocodeValue']);

        }catch (ModelNotFoundException $exception) {
            Response::json(
                content: ['Введен неверный промокод, пожалуйста, повторите попытку'],
                type: Response::RESPONSE_ERROR_TYPE,
                status: 422
            );
        }

        Response::json(
            content: $promocode
        );
    }
}