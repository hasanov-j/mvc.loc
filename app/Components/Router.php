<?php

declare(strict_types=1);

namespace App\Components;

class Router
{
    private array $routes;

    public function __construct()
    {
        $routesPath = CONFIG_ROOT.'routes.php';
        $this->routes = include $routesPath;
    }

    public function run(): void
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $routeData) {
            if (preg_match("~^{$uriPattern}$~", $uri)) {
                foreach ($routeData as $method => $routeItem) {
                    if ($_SERVER['REQUEST_METHOD'] === $method) {
                        $controllerName = $routeItem['controller'];

                        $actionName = $routeItem['action'];

                        // Забрать группы как аргументы

                        $parameters = [];
                        preg_match("~^{$uriPattern}$~", $uri, $parameters);

                        // Исключаем первый элемент, который содержит полные совпадения
                        array_shift($parameters);
                        $controllerObject = new $controllerName();

                        //                        if(call_user_func_array([$controllerObject, $actionName], $parameters)==null){
                        //                            throw new Exception("Incorrect argument resolver at: $controllerName, $actionName action");
                        //                        }

                        $controllerObject->{$actionName}(...$parameters);

                        exit;
                    }

                    continue;
                }
            }
        }

        Redirect::byStatusCode(statusCode: 404);
    }

    private function getURI()
    {
        return (!empty($_SERVER['REQUEST_URI'])) ? trim($_SERVER['REQUEST_URI'], '/') : null;
    }
}
