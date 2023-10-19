<?php

namespace App\Controllers\Frontent\Api;

use App\Components\Request;
use App\Components\Response;
use App\Exception\ModelException\ModelNotFoundException;
use App\Models\Dish;

class SearchApiController
{
    public function index(): void
    {
        $searchTerm=null;

        $requestData =  Request::getContent();

        if(array_key_exists('q', $requestData)){
            $searchTerm = Request::getContent()['q'];
        }

        $dishes = null;

        try {
            $dishes = Dish::getAllWithIngredients(searchTerm: $searchTerm);
        }catch (ModelNotFoundException $exception){
            Response::json(
                status: 404,
                type: Response::RESPONSE_ERROR_TYPE,
                message: "Dishes by this search term - {$searchTerm} not found"
            );die;
        }

        Response::json(
            [
                'dishes'=> $dishes,
            ]
        );
    }
}