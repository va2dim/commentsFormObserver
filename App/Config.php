<?php

namespace App;

/**
 * Class Config for taking declared DB params (./config.php)
 * @package App
 */
class Config
  implements \ArrayAccess//, \Iterator
{
    use Singletone;
    use TCollection;

    public $item;

    protected function __construct()
    {
        $this->item = include __DIR__ . '/../config.php';
    }

}