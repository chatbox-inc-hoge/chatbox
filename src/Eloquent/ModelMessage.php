<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/01/11
 * Time: 21:34
 */

namespace Chatbox\Chatbox\Eloquent;

class ModelMessage extends Base{

    protected $schema = "message";

    protected $fillable = ['room_id','user_obj','msg_obj'];

//    public function insert($roomId)

    static public function read($roomId,$limit){
        $data = static::where("roomId",$roomId)->limit($limit)->get();
        $rtn = [];
        foreach($data as $d){
            $rtn[] = $d->parseArray();
        }
        return $rtn;
    }

    /**
     * LIST取得用の配列変換
     */
    public function parseArray(){
        $data = [];
        $data["user"] = unserialize($this->user_obj);
        $data["msg"] = unserialize($this->msg_obj);
        $data["created_at"] = $this->created_at;
        return $data;
    }

    static public function insert($roomId,$usrObj,$msgObj){
        static::create([
            "room_id" => $roomId,
            "user_obj" => serialize($usrObj),
            "msg_obj" => serialize($msgObj),
        ]);

    }



}