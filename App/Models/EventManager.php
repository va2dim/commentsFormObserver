<?php

namespace App\Models;

use App\Model;
use App\Singletone;
use SplObserver;

/**
 * Subject, who makes comments (Observable)
 */
class EventManager extends Model implements \SplSubject
{
    use Singletone;

    const TABLE = 'comments';

    public $body;
    public $author;

    private $observers = array();

    protected function __construct()
    {
    }

    /**
     * Attach Observer to Event (Observerable)
     * @param \SplObserver $observer
     * @return void
     */
    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * Detach Observer from Event (Observerable)
     * @param \SplObserver $observer
     * @return void
     */
    public function detach(SplObserver $observer)
    {
        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    /**
     * Notify Observers about Event (Observerable)
     * @return void
     */
    public function notify()
    {
        foreach ($this->observers as $value) {
            $value->update($this);
        }
    }

    /**
     * Get content of Comment body
     * @return string
     */
    public function getContent() {
        return $this->body;
    }

    /**
     * Set content for Comment body (need for saving Unicode native text in DB, through convert to shortName)
     * @param string $body
     * @return void
     */
    public function setContent($body) {
        $this->body = $body;

    }

    /**
     * Notification Event for Observers
     * @param string $body
     * @return void
     */
    public function onSubmit($body)
    {
        $this->body = $body;
        $this->notify();
    }
}