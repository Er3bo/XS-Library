<?php

class RouterManager
{
    private $controller;
    private $action;

    public function __construct(string $request)
    {
        $routes = require('routes.php');
        if (array_key_exists($request, $routes)) {
            $finalRoute = explode('@', $routes[$request]);
            $this->controller = reset($finalRoute);
            $this->action = end($finalRoute);
        }
    }

    public function createController()
    {
        if (class_exists($this->controller)) {
            $parents = class_parents($this->controller);
            if (in_array("Controller", $parents)) {
                if (method_exists($this->controller, $this->action)) {

                    return new $this->controller($this->action);
                } else {
                    // Method Does Not Exist
                    echo '<h1>Method does not exist</h1>';

                    return;
                }
            } else {
                // Base Controller Does Not Exist
                echo '<h1>Base controller not found</h1>';

                return;
            }
        } else {
            // Controller Class Does Not Exist
            echo '<h1>Controller class does not exist</h1>';

            return;
        }
    }
}
