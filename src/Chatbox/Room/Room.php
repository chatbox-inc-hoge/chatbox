<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/03
 * Time: 15:57
 */

namespace Chatbox\Chatbox\Room;

use Chatbox\Container\ArrayContainerTrait;
use Chatbox\Chatbox\Eloquent\ModelRoom;

class Room {

    use ArrayContainerTrait;

    /**
     * @var RoomMessageList
     */
    protected $messages;

    /**
     * @var RoomMemberList
     */
    protected $members;

    function __construct(array $data = [],$roomId=null)
    {
        $this->merge($data);
        if($roomId){
            $this->members = new RoomMemberList($roomId);
            $this->messages = new RoomMessageList($roomId);
        }
    }

    /**
     * @return RoomMessageList
     */
    public function getMessages()
    {
        if($this->messages){
            return $this->messages;
        }else{
            throw new \Exception("cant get MessageObject");
        }
    }

    /**
     * @return RoomMemberList
     */
    public function getMembers()
    {
        if($this->members){
            return $this->members;
        }else{
            throw new \Exception("cant get MembersObject");
        }
    }

    public function getById($id){
        if($model = ModelRoom::where("id",$id)->first()){
            return $this->getByModel($model);
        }else{
            return null;
        }
    }

    public function getByModel(ModelRoom $model){
        $data = json_decode($model->data,true);
        return new static($data,$model->id);
    }

    public function create(){
        $model = ModelRoom::create([
            "data" => json_encode($this->toArray())
        ]);
        return $this->getByModel($model);
    }








}