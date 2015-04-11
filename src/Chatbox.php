<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/06
 * Time: 19:06
 */

namespace Chatbox\Chatbox;

use Chatbox\Box\Box;
use Chatbox\Chatbox\Room;
use Chatbox\Traits\InstanceManager;

use Chatbox\Chatbox\Schema\SchemaContainer;


/**
 * Class SignUp
 *
 * invitation [protected]
 * invitation_kvs
 *
 *
 * @package Chatbox\Auth
 */
class Chatbox extends Box{

    use InstanceManager;

    /**
     * @return Config
     */
    static public function defaultConfig(){
        $config = new Config;
        $config->load(__DIR__."/../config/chatbox.php");
        return $config;
    }

    protected $config;

    public function __construct(Config $config=null){
        $this->configure();
        if(is_null($config)){
            $config = $this->defaultConfig();
        }
        $this->register("config",[],$config);
        $this->getService("config");
    }

    protected function configure()
    {
        parent::configure();
        $this->register("schema",["config"],function($config){
            $schema = new SchemaContainer("chatbox");
            $schema->setGlobal();
            return $schema;
        });
        $this->register("mapper",["schema"],function($schema){
            $mapper = new Mapper($schema);
            return $mapper;
        });
        $this->register("room",["mapper"],function($mapper){
            $room = new Room($mapper);
            return $room;
        });
//        $this->register("invitation",["config","user"],new InvitationProvider());
//        $this->register("auth",["config","user"],new AuthDriverProvider());
//        $this->register("serializer",["config"],new SerializerProvider());
    }

    /**
     * @return Room
     */
    protected function getRoom(){
        return $this->getService("room");
    }

    /**
     * @param $type
     * @return Room
     */
    public function createRoom($data){
        $room = $this->getRoom();
        $room = $room->factory($data);
        return $room;
    }
    /**
     * @param $type
     * @return Room
     */
    public function getRoom($id){
        $room = $this->getRoom();
        $room = $room->getById($id);
        return $room;
    }

    /**
     * @return SchemaContainer
     */
    public function getSchema(){
        return $this->getService("schema");
    }
}