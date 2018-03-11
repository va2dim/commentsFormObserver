<?php

namespace App\Controllers;


use App\Models\Comment;

class Comments extends Index
{

    public function actionIndex()
    {
        $this->view->comments = \App\Models\Comment::findAll();

        $this->view->display(__DIR__ . '/../templates/index.php');
    }

    public function actionCreate()
    {
        if (!empty($_POST['body']))
        {
            $newComment = new Comment();
            $newComment->parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;
            $newComment->body = $_POST['body'];
            $newComment->author_id = !empty($_POST['author_id']) ? $_POST['author_id'] : null;
            $newComment->save();
            echo '<br>NEW COMMENT: ';
            var_dump($newComment);
            echo '<br>';
        }
        $this->view->comments = \App\Models\Comment::findAll();
        $this->view->display(__DIR__ . '/../templates/index.php');

        $this->view->display(__DIR__ . '/../templates/create.php');
    }
}