<?php

namespace App\Controllers;

use App\Models\EventManager;
use App\Models\EventSubscriber;

class Comments extends Index
{
    /**
     *  Initialise & attache EventSubscribers (Observer) to EventManager (Observerable),
     *  save EventManager(Comment) Model data to DB
     *  @return void
     */
    public function actionCreate()
    {
        if (!empty($_POST['body'])) {
            $comment = EventManager::instance();

            $commentSubscribers = EventSubscriber::findAll();
            $eventSubscriber = [];
            foreach ($commentSubscribers as $commentSubscriber) {
                $eventSubscriber[] = new EventSubscriber($commentSubscriber->name);
                $comment->attach(end($eventSubscriber));
            }

            $comment->body = $_POST['body'];
            $comment->author = !empty($_POST['author']) ? $_POST['author'] : null;

            $comment->onSubmit($comment->body);
            $comment->save();
        }

        $this->view->comments = EventManager::findAll();
        $this->view->display(__DIR__ . '/../templates/index.php');

        $this->view->display(__DIR__ . '/../templates/create.php');
    }
}