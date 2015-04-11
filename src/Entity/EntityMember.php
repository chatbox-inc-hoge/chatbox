<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/03
 * Time: 15:57
 */

namespace Chatbox\Chatbox\Entity;

use Chatbox\Chatbox\Eloquent\ModelMember;
use Chatbox\Chatbox\ChatboxUserInterface as UserInterface;

class EntityMember{

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
    public function is_member($token){
        $rtn = false;
        if(in_array($token,$this->getMemberList())){
            $rtn = true;
        }
        return $rtn;
    }

    public function is_kicked($token){
        $rtn = false;
        if(in_array($token,$this->getKickedList())){
            $rtn = true;
        }
        return $rtn;

    }

    public function enter($token){
        if($this->is_member($token)){
            throw new \Exception("the user is already entered");
        }
        if($this->is_kicked($token)){
            throw new \Exception("the user is kicked");
        }
        ModelMember::insert($this->roomId, $token);
        $this->memberList[] = $token;
    }

    public function leave($token){
        if($this->is_kicked($token)){//キックされてるユーザが逃げれないように先に判定
            throw new \Exception("the user is kicked");
        }
        if(!$this->is_member($token)){//もとより入ってない奴は出れない
            throw new \Exception("the user is already entered");
        }
        $model = ModelMember::findUserRow($this->roomId,$token);
        if($model){
            $model->delete();
        }else{
            throw new \Exception("cant get member data");
        }
        foreach($this->memberList as $index => $value){
            if($value == $token){
                unset($this->memberList[$index]);
            }
        }
    }

    public function kick($token)
    {
        if($this->is_member($token)){
            $model = ModelMember::findUserRow($this->roomId,$token);
            $model->update([
                "is_kicked" => true
            ]);
        }else{
            throw new \Exception("the user is not entered");
        }
    }

}