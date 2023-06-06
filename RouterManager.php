<?php

class RouterManager
{
    private $controller;
    private $action;
    private $request;

    public function __construct($request)
    {
        $routes = require ('routes.php');
        foreach ($routes as $requestUrl => $routeTo) {
            if ($requestUrl == $request)
            {
                $finalRoute = explode('@',$routeTo);
                $this->controller = reset($finalRoute);
                $this->action = end($finalRoute);
            }
        }
    }

    public function createController()
    {
        // Check Class
        if (class_exists($this->controller)) {
            $parents = class_parents($this->controller);
            // Check Extend
            if (in_array("Controller", $parents)) {
                if (method_exists($this->controller, $this->action)) {
                    return new $this->controller($this->action, $this->request);
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
?>