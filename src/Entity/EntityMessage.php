<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/03
 * Time: 15:57
 */

namespace Chatbox\Chatbox\Entity;

use Chatbox\Chatbox\Eloquent\ModelMessage;
use Chatbox\Chatbox\Eloquent\ModelReadtime;

class EntityMessage {

    private $roomId;

    function __construct($roomId)
    {
        $this->roomId = $roomId;
    }

    public function insert($userObj,$msgObj){
        ModelMessage::insert($this->roomId,$userObj,$msgObj);
    }

    /**
     * 毎回上から取得する。
     * 引数にユーザトークン渡せば、キレイにReadTime書き込んでくれる。
     * @param int $limit
     */
    public function load($limit=20,$userToken=null){
        ModelMessage::read($this->roomId,$limit);
        if($userToken){
            ModelReadtime::record($this->roomId,$userToken);
        }

    }
}