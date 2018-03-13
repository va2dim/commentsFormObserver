<?php

namespace App\Models;

use App\Model;

use Emojione\Client;
use Emojione\Ruleset;

/**
 * Observer, that who recieves comment, observe it (in Emoji image form) & send it back for saving in DB (Emoji shortName)
 */
class EventSubscriber extends Model implements \SplObserver
{
    const TABLE = 'observers';

    public $name;
    private $subscriber;

    public function __construct($subscriber = '') {
        $this->subscriber = $subscriber;
    }

    /**
     * Convert Emoji in comment
     * @param \SplSubject $subject
     * @return void  modified comment in output, for saving in DB
     */
    public function update(\SplSubject $subject)
    {
        $client = new Client(new Ruleset());

        if(!empty($subject->getContent())) {
            $subject->setContent($client->toShort($subject->getContent()));
            $emojiImageContent =  $client->toImage($subject->getContent());
        }

        echo 'Наблюдатель '.$this->subscriber.' подписан на получение модифицированных комментариев: '.$emojiImageContent.'<br>';
    }
}