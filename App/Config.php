<?php

namespace App;


class Config
  implements \ArrayAccess//, \Iterator
{
    use Singletone;
    use TCollection;

    public $item;

    protected function __construct()
    {

        //self::$instance =
        $this->item = include __DIR__ . '/../config.php';
        //var_dump(self::$instance);
    }

}