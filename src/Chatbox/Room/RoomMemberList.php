<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/03
 * Time: 15:57
 */

namespace Chatbox\Chatbox\Room;

use Chatbox\Chatbox\Eloquent\ModelMember;
use Chatbox\Chatbox\ChatboxUserInterface as UserInterface;

class RoomMemberList {

    private $roomId;
    private $memberList;
    private $kickedList;

    function __construct($roomId)
    {
        $this->roomId = $roomId;
    }


    private function load(){
        $list = ModelMember::where("room_id",$this->roomId)->get();
        $this->memberList = [];
        $this->kickedList = [];
        foreach($list as $memberModel){
            $this->memberList[] = $memberModel->user_id;
        }
    }

    public function getMemberList(){
        if(is_null($this->memberList)){
            $this->load();
        }
        return $this->memberList;
    }
    public function getKickedList(){
        if(is_null($this->kickedList)){
            $this->load();
        }
        return $this->kickedList;
    }

    /**
     * 入室しているユーザかどうかの検証
     * @param UserInterface $user
     * @param bool $includeKicked
     * @return bool
     */
    public function is_member(UserInterface $user){
        $rtn = false;
        if(in_array($user->chatboxGetId(),$this->getMemberList())){
            $rtn = true;
        }
        return $rtn;
    }

    public function is_kicked(UserInterface $user){
        $rtn = false;
        if(in_array($user->chatboxGetId(),$this->getKickedList())){
            $rtn = true;
        }
        return $rtn;

    }

    public function enter(UserInterface $user){
        if($this->is_member($user)){
            throw new \Exception("the user is already entered");
        }
        if($this->is_kicked($user)){
            throw new \Exception("the user is kicked");
        }
        ModelMember::create([
            "room_id" => $this->roomId,
            "user_id" => $user->chatboxGetId(),
            "is_kicked" => false
        ]);
    }

    public function leave($user){
        if($this->is_kicked($user)){//キックされてるユーザが逃げれないように先に判定
            throw new \Exception("the user is kicked");
        }
        if(!$this->is_member($user)){//もとより入ってない奴は出れない
            throw new \Exception("the user is already entered");
        }
        $model = ModelMember::where([
            "room_id" => $this->roomId,
            "user_id" => $user->chatboxGetId(),
        ])->first();
        if($model){
            $model->delete();
        }else{
            throw new \Exception("cant get member data");
        }

    }

}