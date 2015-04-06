<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/06
 * Time: 19:06
 */

namespace Chatbox;

use Chatbox\Box\Box;
use Chatbox\Chatbox\Config;

use Chatbox\Traits\InstanceManager;


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
     * @throws Container\Exception
     */
    static public function defaultConfig(){
        $config = new Config;
        $config->load(__DIR__."/../config/chatbox.php");
        return $config;
    }

    protected $config;

    public function __construct(Config $config=null){
        if(is_null($config)){
            $config = $this->defaultConfig();
        }
        $this->register("config",[],$config);
        $this->configure();
    }

    public function configure()
    {
        parent::configure();
        $this->register("room",["config"],function($config){
            return new Room();
        });
        $this->register("invitation",["config","user"],new InvitationProvider());
        $this->register("auth",["config","user"],new AuthDriverProvider());
//        $this->register("serializer",["config"],new SerializerProvider());
    }

    /**
     * @param $type
     * @return UserInterface
     */
    public function user(){
        $user = $this->getService("user");
        return $user;
    }
    /**
     * @param $type
     * @return Driver\AuthDriverInterface
     */
    public function auth($type){
        $arr = $this->getService("auth");
        if($auth = Arr::get($arr,$type)){
            return $auth;
        }else{
            throw new \DomainException("non exist service to be fetch");
        }
    }

    public function createUser(){

    }
}