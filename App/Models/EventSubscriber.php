<?php

namespace App\Models;

use App\Model;

use Emojione\Client;
use Emojione\Ruleset;

class EventSubscriber extends Model implements \SplObserver
{
    const TABLE = 'observers';

    public $name;
    private $subscriber;

    public function __construct($subscriber = 'Test') {
        $this->subscriber = $subscriber;
    }

    public function update(\SplSubject $subject)
    {
        $client = new Client(new Ruleset());

        if(!empty($subject->getContent())) {
            $emojiImageContent =  $client->toImage($subject->getContent());
        }

//$client->toImage(":) :-( 😆 :smile: :joy: 😂 ")

        echo $this->subscriber.' is subscribed to comment '.$emojiImageContent.'<br>';
    }
}