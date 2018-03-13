<?php

namespace App;

/**
 * Class View implements templating
 * @package App
 */
class View
{
    use Magic;

    /**
     * Template rendering
     * @param $template
     * @return string
     * @throws \App\MultiException
     */
    function render($template)
    {
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

    /**
     * Display rendered template
     * @param $template
     */
    function display($template)
    {
        echo $this->render($template);
    }
}