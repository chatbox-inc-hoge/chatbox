<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/01/11
 * Time: 21:34
 */

namespace Chatbox\Chatbox\Eloquent;

use Chatbox\Chatbox\Schema\ChatboxMember;

class ModelMember extends Base{

    protected $fillable = ['room_id','user_id','is_kicked'];

    public function getSchema()
    {
        return new ChatboxMember("chatbox_member");
    }


}