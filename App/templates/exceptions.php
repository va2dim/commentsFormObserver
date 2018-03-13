<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catched Exception</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h1>Отловленные исключения:</h1>
<?php foreach ($errors as $error): ?>
    <div class="alert alert-danger">
        !!!! <?php echo $error->getMessage(); ?></div>
<?php endforeach; ?>

</body>
</html>

