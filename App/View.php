<?php

namespace App;

use Countable;

class View
  implements \Countable
{
    use Magic;

    function render($template)
    {
        //var_dump(static::$data);
        /*
        foreach (static::$data as $prop => $value ) {
//            /$$prop = $value;
            //echo $prop. '='; var_dump($value); echo "333<hr>";
            //echo $value->id;
        }
        */
        //echo $news;

        ob_start();
        foreach (static::$data as $prop => $value) {
            $$prop = $value;
        }


        if (false == include $template) {
            $e = new MultiException();
            $e[] = new \App\Exceptions\Core('Ошибка 404 - файл-шаблон ' . $template . ' не найден');
            throw $e;
        }


        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    function display($template)
    {
        echo $this->render($template);
        //unset(static::$data);
    }


    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        //TODO не работает count(object)
        //var_dump($this->data);

        //echo array_count_values($this->data);
        return count($this->data);
    }
}