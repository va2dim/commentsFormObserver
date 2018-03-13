<?php

namespace App\Controllers;

use App\View;

/**
 * Class Index  Base Controller
 * @package App\Controllers
 */
class Index
{
    protected $view;

    /**
     * Initialize View object for templating
     */
    public function __construct()
    {
        $this->view = new View();
        $this->view->uri = '/' . explode('/', $_SERVER["REQUEST_URI"], 3)[1];
    }

    /**
     * @param $action
     * @return mixed Method for execution
     */
    public function action($action)
    {
        $methodName = 'action' . $action;

        try {
            return $this->$methodName();
        } catch (MultiException $e) {
            $this->view->errors = $e;
            $this->view->display(__DIR__ . '/../templates/exceptions.php');
        }
    }
}