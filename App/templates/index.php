<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Comment Observer Form</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>Все комментарии</h1>


<?php
//var_dump($comments);
foreach ($comments as $comment): ?>
    <div class="panel panel-info">
        <div class="panel-heading"><a
                    href="<?php echo $uri; ?>/comment/author/<?php echo $comment->author_id; ?>"><?php echo $comment->author_id; ?></a>
        </div>
        <div class="panel-body"><?php echo $comment->body; ?><a
                    href="<?php echo $uri; ?>&id=<?php echo $comment->id; ?>">
                <span class="glyphicon glyphicon-expand"
                      aria-label=">>>"></span> </a></div>
        <div class="panel-footer">

            <div class="row">
                <div class="col-md-10">
                    <?php /*
                    if (isset($comment->author)):
                        echo $comment->author->name;
                    endif;*/
                    ?>
                </div>
                <div class="col-md-2 text-right">
                    <?php /*
                    if (isset($comment->dtoc)):
                        echo $comment->dtoc;
                    endif;*/
                    ?>
                </div>
            </div>

        </div>
    </div>
<?php endforeach; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

