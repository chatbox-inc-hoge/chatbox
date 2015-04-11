<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/01/11
 * Time: 21:34
 */

namespace Chatbox\Chatbox\Eloquent;

class ModelReadtime extends Base{

    protected $schema = "readtime";

    protected $fillable = ['room_id','user_token'];

//    public function insert($roomId)

    static public function record($roomId,$userToken)
    {
        $row = static::where([
            "room_id" => $roomId,
            "user_token" => $userToken
        ])->first();
        if ($row) {
            $row->update();
        } else {
            static::create([
                "room_id" => $roomId,
                "user_token" => $userToken
            ]);
        }
    }
}