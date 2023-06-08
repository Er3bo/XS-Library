<?php

abstract class Controller
 {
    private $action;

    public function __construct($action, $request) {
        $this->action = $action;
    }

    public function executeAction() {
        return $this->{$this->action}();
    }

    /**
     * Returns a view with data
     *
     * @param $view
     * @param array $data
     *
     * @return void
     */
    protected function runThis($view, array $data = []) {
        extract($data);
        require('view/'.$view);
    }
}
?>