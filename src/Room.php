<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/06
 * Time: 19:11
 */

namespace Chatbox\Chatbox;

class Room {

    /**
     * @var Mapper
     */
    protected $mapper;

    protected $roomId;

    function __construct(Mapper $mapper,$roomId=null)
    {
        $this->mapper = $mapper;
        $this->roomId = $roomId;
    }

    protected function newInstance($roomId){
        return new static($this->mapper,$roomId);
    }

    ## region entity getter

    protected function entityRoom(){

        return
    }

    ## endregion


    ## region factory

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

    public function factory($data){
        $model = ModelRoom::create([
            "data" => json_encode($data)
        ]);
        return $this->getByModel($model);
    }

    ## endregion

    ## region member dealing

    public function memberTokens(){

    }

    public function enter($userToken){
        $this->memberList()->enter($userToken);
    }

    public function leave($userToken){
        $this->memberList()->leave($userToken);
    }

    public function kick($userToken){
        $this->memberList()->kick($userToken);
    }

    ## endregion

    ## region message

    public function messages($userObj,$msgObj){
        $this->messageList()->insert($userObj,$msgObj);
    }

    public function say(){


    }

    ## endregion






}