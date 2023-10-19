<?php

namespace App\Controllers\Frontent\Web;

use App\Components\Redirect;
use App\Components\Request;
use App\Components\Session;
use App\Exception\ModelException\ModelInsertErrorException;
use App\Exception\ModelException\ModelNotFoundException;
use App\Models\DishOrder;
use App\Models\Order;
use App\Models\OrderPromocode;
use App\Service\Auth\AuthServiceProvider;
use App\Service\Auth\Exception\Web\AuthWebException;
use App\Service\Auth\WebAuthService;
use Ramsey\Uuid\Uuid;

class OrderController
{
    private WebAuthService $webService;
    private array $errors = [];

    public function __construct()
    {
        try {
            AuthServiceProvider::isAuthCheck($this->webService = new WebAuthService);
        } catch (AuthWebException $exception) {
            $this->errors[] = 'Прежде чем сделать заказ, пожалуйста, пройдите регистрацию';
            Session::set(name: 'errors', value: $this->errors);
            Redirect::back();
            die;

        }

    }

    public function store()
    {

        $requestData = json_decode(Request::getContent()['cartData'], true);
        if (!empty($requestData['cartDishes'])) {
            $dishes = $requestData['cartDishes'];
        } else {
            $this->errors[] = 'Пожалуйста, выберите блюдо для оформление заказа';
            Session::set(name: 'errors', value: $this->errors);
            Redirect::back();

        }

        $promocodes = null;
        $paymentType = $requestData['paymentMethod'];
        $user = AuthServiceProvider::findAuthUser($this->webService);
        $orderPrice = null;

        foreach ($dishes as $dish) {
            $orderPrice += $dish['dish_cost'] * $dish['dish_quantity'];
        }

        $orderTotalPrice = $orderPrice;
        //var_dump($user);die;
        if (!empty($requestData['promocodes'])) {
            $promocodes = $requestData['promocodes'];
            foreach ($promocodes as $promocode) {
                $orderTotalPrice -= $orderTotalPrice * $promocode['discount'] / 100;
            }
        }

        $orderUuid = Uuid::uuid4()->toString();

        try {
            Order::create(
                idUsers: $user['id'],
                paymentType: $paymentType,
                price: $orderTotalPrice,
                uuid: $orderUuid
            );
        } catch (ModelInsertErrorException $exception) {

            $this->sendError();die;
        }

        try {
            $order = Order::getOneByUuid($orderUuid);
        } catch (ModelNotFoundException $exception) {
            $this->sendError();die;
        }

        if(!empty($promocodes)){
            foreach ($promocodes as $promocode) {
                try {
                    OrderPromocode::create(orderId: $order['id'],promocodeId: $promocode['id']);
                } catch (ModelInsertErrorException $exception){
                    $this->sendError();die;
                }
            }
        }


        foreach ($dishes as $dish){
            try {
                DishOrder::create(
                    orderId: $order['id'],
                    dishId: $dish['dish_id'],
                    quantity: $dish['dish_quantity']
                );
            } catch (ModelInsertErrorException $exception){
                $this->sendError();die;
            }

        }

        Redirect::orderAccess();

    }

    private function sendError(): void
    {
        $this->errors[] = 'Произошла ошибка при оформлении заказа, пожалуйста, повторите попытку позже';
        Session::set(name: 'errors', value: $this->errors);
        Redirect::back();die;
    }
}