<?php

namespace App\Controllers;

use App\View;

class Index
{

    protected $view;

    //protected $errors;

    public function __construct()
    {


        $this->view = new View();
        // TODO $uri define as CONST in boot.php;
        $this->view->uri = '/' . explode('/', $_SERVER["REQUEST_URI"], 3)[1];
    }

    /**
     * Proxy Action
     * У всего С в целом можем проводить какие-то действия до action в beforeAction()
     * @param $action
     * @return mixed
     */
    public function action($action)
    {
        $methodName = 'action' . $action;
        $this->beforeAction();

        try {
            return $this->$methodName();
        } catch (MultiException $e) {
            $this->view->errors = $e;
            $this->view->display(__DIR__ . '/../templates/exceptions.php');
        }


        /*
        catch (\App\Exceptions\Core $e) {

            //$this->view->errors = 'FC: Возникло исключение приложения: '.$e->getMessage();
            echo '<br>FC: Возникло исключение приложения: <br>';
            $this->view->errors = $e;
            var_dump($this->view->errors);
                $this->view->display(__DIR__ . '/../templates/exceptions.php');
        }
        catch (\App\Exceptions\DB $e) {
            $this->view->errors = $e;
            //$this->view->errors = 'FC: Что-то не так с БД: '.$e->getMessage();

        }
        */
    }

    public function beforeAction()
    {
    }

    protected function actionIndex()
    {
        //var_dump(return include '\quotes.txt';);

        //$this->view->news = News::findLast(3);
        $this->view->comments = \App\Models\Comment::findAll();
        $this->view->display(__DIR__ . '/../templates/index.php');
    }
}