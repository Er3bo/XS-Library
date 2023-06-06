<?php

abstract class Controller
 {
    protected $request;
    protected $action;

    public function __construct($action, $request) {
        $this->action = $action;
        $this->request = $request;
    }

    public function executeAction() {
        return $this->{$this->action}();
    }

    protected function runThis($view, $data = false) {
        if ($data) {
            extract($data);
        }
        require('view/'.$view);
    }
}
?>