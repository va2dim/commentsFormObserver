<?php

namespace App\Models;

use App\Model;

class EventSubscriber extends Model implements \SplObserver
{
    const TABLE = 'observers';

    public $name;
    private $subscriber;

    public function __construct($subscriber = 'Test') {
        $this->subscriber = $subscriber;
    }

    public function update(\SplSubject $subject) {
        echo $this->subscriber.' is subscribed to <b>'.$subject->getContent().'</b><br>';
    }


}