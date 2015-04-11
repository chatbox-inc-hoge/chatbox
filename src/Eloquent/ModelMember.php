<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/01/11
 * Time: 21:34
 */

namespace Chatbox\Chatbox\Eloquent;

class ModelMember extends Base{

    static public function insert($roomId,$userToken){
        static::create([
            "room_id" => $roomId,
            "user_token" => $userToken,
            "is_kicked" => "0",
        ]);
    }

    /**
     * @param $roomId
     * @param $userToken
     * @return static
     */
    static public function findUserRow($roomId,$userToken){
        return static::where([
            "room_id" => $roomId,
            "user_token" => $userToken
        ])->first();
    }


    protected $schema = "member";

    protected $fillable = ['room_id','user_token','is_kicked'];

}