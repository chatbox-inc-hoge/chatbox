<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/04
 * Time: 14:22
 */
namespace Chatbox\Chatbox\Schema;
use Chatbox\Migrate\Schema\Column;

class ChatboxRoom extends Base{


    public function configure()
    {
        parent::configure();
        $this->setSurrogateKey();
        $this->colText("data");
        $this->setDatetime();
    }


}