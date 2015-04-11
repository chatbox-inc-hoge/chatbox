<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/03
 * Time: 15:57
 */

namespace Chatbox\Chatbox\Entity;

use Chatbox\Container\ArrayContainerTrait;
use Chatbox\Container\PropertyContainerTrait;

class EntityRoom {

    use PropertyContainerTrait;

    protected $room_id;
    protected $data;
    protected $created_at;
    protected $updated_at;

    function __construct(array $data = [])
    {
        $this->setData($data);
    }
//
//    /**
//     * @return RoomMessageList
//     */
//    protected function messageList()
//    {
//        if($this->roomId){
//            return new RoomMessageList($this->roomId);
//        }else{
//            throw new \Exception("cant get MessageObject");
//        }
//    }
//
//    /**
//     * @return RoomMemberList
//     */
//    public function memberList()
//    {
//        if($this->roomId){
//            return new RoomMemberList($this->roomId);
//        }else{
//            throw new \Exception("cant get MembersObject");
//        }
//    }





}