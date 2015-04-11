<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/04
 * Time: 14:22
 */
namespace Chatbox\Chatbox\Schema;

use Chatbox\Traits\InstanceManager;
use Chatbox\Chatbox\Eloquent\ModelRoom;
use Chatbox\Chatbox\Eloquent\ModelMember;
use Chatbox\Arr;


class SchemaContainer extends \Chatbox\Migrate\Util\SchemaContainer{

    use InstanceManager;

    protected $prefix = "chatbox";

    public function configure()
    {
        $this->addSchema("room",function(){
            return new ChatboxRoom($this->tableName("room"));
        });
        $this->addSchema("member",function(){
            return new ChatboxMember($this->tableName("member"));
        });
        $this->addSchema("message",function(){
            return new ChatboxMessage($this->tableName("message"));
        });
        $this->addSchema("readtime",function(){
            return new ChatboxReadTime($this->tableName("readtime"));
        });
    }
}