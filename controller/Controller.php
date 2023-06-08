<?php

abstract class Controller
 {
    private $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function executeAction(): array
    {
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
    protected function runThis(string $view, array $data = []): bool
    {
        extract($data);

        require('view/'.$view);

        return true;
    }
}
?>