<?php

namespace App;

/**
 * Trait Singletone implement Singletone pattern
 * @package App
 */
trait Singletone
{
    protected static $instance;

    protected function __construct()
    {
    }

    static public function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}