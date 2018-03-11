<?php

namespace App\Models;

use App\Model;

class Comment extends Model
{
    const TABLE = 'comments';

    public $parent_id;
    public $body;
    public $author_id;


}