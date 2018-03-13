<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comment Observer Form</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h1>Все комментарии</h1>

<?php foreach ($comments as $comment): ?>
    <li class="list-group-item">
        <div class="blog-post-comment">
            <p class="blog-post-meta">
                Комментарий № <?php echo $comment->id; ?>
                <?php echo ($comment->author) ? 'оставлен '.$comment->author : '';?>
            </p>
            <p>
                <?php echo $comment->body ?>
            </p>
        </div>
    </li>
<?php endforeach; ?>

</body>
</html>

