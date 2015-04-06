<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/01/11
 * Time: 21:34
 */

namespace Chatbox\Chatbox\Eloquent;

use Chatbox\Chatbox\Schema\ChatboxRoom;

class ModelRoom extends Base{

    protected $fillable = ['data'];

    public function getSchema()
    {
        return new ChatboxRoom("chatbox_room");
    }
}