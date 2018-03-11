<?php

/**
 * TODO __autoload
 * @return false если файл класса не найден - use если несколько ф-ций __autoload, тогда spl_autoload_register() принимает эти ф-ции и + в очередь.
 *
 * Пример преобразования
 * App\Models\User => ./App/Models/User.php
 */
function __autoload($class_name)
{
    require __DIR__ . '/' . str_replace('\\', '/', $class_name) . '.php';

    // SPL composer сам делает
    //include __DIR__ . '/vendor/autoload.php';
}