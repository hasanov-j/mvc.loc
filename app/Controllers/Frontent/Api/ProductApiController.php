<?php

namespace App\Controllers\Frontent\Api;

use App\Components\Request;
use App\Components\Response;
use App\Exception\ModelException\ModelNotFoundException;
use App\Models\Category;
use App\Models\Dish;

class ProductApiController
{
    public function index(): void
    {
        //var_dump($_SERVER['REQUEST_URI']);
        $categoryId=null;

        if(array_key_exists('categoryId',Request::getContent())){
            $categoryId = Request::getContent()['categoryId'];
        }

        $dishes = null;

        try {
            $dishes = Dish::getAllWithIngredients(categoryId: $categoryId);
        }catch (ModelNotFoundException $exception){
            Response::json(status: 404, type: Response::RESPONSE_ERROR_TYPE, message: "Products by category id - {$categoryId} not found");die;
        }

        Response::json(
            [
                'dishes'=> $dishes,
                'categories'=>Category::getALL(),
            ]
        );
    }
}