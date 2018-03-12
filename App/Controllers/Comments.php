<?php

namespace App\Controllers;

use App\Models\EventManager;
use App\Models\EventSubscriber;

//use App\Models\EventSubscriber;

class Comments extends Index
{

    public function actionIndex()
    {
        $this->view->comments = EventManager::findAll();

        $this->view->display(__DIR__ . '/../templates/index.php');
    }

    public function actionCreate()
    {
        if (!empty($_POST['body']))
        {
            $comment = EventManager::instance();

            $commentSubscribers = EventSubscriber::findAll();
            $eventSubscriber = [];
            foreach ($commentSubscribers as $commentSubscriber) {
                //var_dump($commentSubscriber);
                $eventSubscriber[] = new EventSubscriber($commentSubscriber->name);
                //var_dump(end($eventSubscriber));
                $comment->attach(end($eventSubscriber));
            }

            $comment->parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;
            $comment->body = $_POST['body'];
            $comment->author = !empty($_POST['author']) ? $_POST['author'] : null;

            $comment->onSubmit($comment->body);
            $comment->detach($eventSubscriber[1]);
            $comment->onSubmit($comment->body);
            $comment->save();
            echo '<br>NEW COMMENT: ';
            var_dump($comment);
            echo '<br>';
        }
        $this->view->comments = EventManager::findAll();
        $this->view->display(__DIR__ . '/../templates/index.php');

        $this->view->display(__DIR__ . '/../templates/create.php');
    }
}