<?php

namespace App;

/**
 * Trait Magic implemets magic methods
 * @package App
 */
trait Magic
{
    protected static $data = [];

    function __set($name, $value)
    {
        static::$data[$name] = $value;
    }

    function __get($name)
    {
        return static::$data[$name];
    }

    function __isset($name)
    {
        if (!in_array($name, static::$data)) {
            echo '<br>Свойство ' . static::class . '->' . $name . ' не существует или =NULL|FALSE';
        }
    }
}