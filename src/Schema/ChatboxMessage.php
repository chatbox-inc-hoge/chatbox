<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/04
 * Time: 14:22
 */
namespace Chatbox\Chatbox\Schema;
use Chatbox\Migrate\Schema\Column;

class ChatboxMessage extends Base{


    public function configure()
    {
        parent::configure();
        $this->setSurrogateKey();
        $this->colRoomId();
        $this->colText("user_obj");
        $this->colText("msg_obj");
        $this->setDatetime();
    }


}