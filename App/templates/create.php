

<html>
<body>

<a name="form"></a>
<form role="form" action="" method="POST"
      class="form-horizontal novalidate">
    <fieldset class="col-lg-6">
        <legend>Добавить комментарий</legend>
        <div class="form-group">
            <label for="id" class="col-lg-2 control-label" hidden>ID
                автора/пользователя</label>
            <div class="col-lg-10">
                <input class="form-control" id="parent_id" name="parent_id"
                       placeholder="parent ID" type="number" readonly
                       value="<?php echo ($comment->parent_id??NULL); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="body" class="col-lg-1 control-label">Текст</label>
            <div class="col-lg-11">
                <textarea class="form-control" rows="7" cols="50" id="body"
                          name="body"
                          placeholder="Введите текст комментария"><?php echo $comment->body??''; ?>
                </textarea>
            </div>
        </div>


        <div class="form-group">
            <label for="select" class="col-lg-1 control-label">Автор</label>
            <div class="col-lg-11">
                <input class="form-control" id="author" name="author"
                       placeholder="Author name" type="text">
<?php /*
                if (isset($comment->author)):
                    echo $comment->author->name;
                endif;*/ ?>

            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-11 col-lg-offset-1">
                <button type="reset" class="btn btn-default">Cбросить</button>
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </div>


    </fieldset>


</form>


<script type="text/javascript" src="<?php echo $uri ?>/clear_form.js"></script>

</body>
</html>