<?php

namespace App\Models;

use App\Model;
use App\Singletone;
use SplObserver;

class EventManager extends Model implements \SplSubject
{
    use Singletone;

    const TABLE = 'comments';

    public $parent_id;
    public $body;
    public $author;

    private $observers = array();

    protected function __construct()
    {
    }

    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $value) {
            $value->update($this);
        }
    }

    public function getContent() {
        return $this->body;
    }

    public function onSubmit($body)
    {
        $this->body = $body;
        $this->notify();
    }
}