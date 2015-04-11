<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/04/06
 * Time: 19:11
 */

namespace Chatbox\Chatbox;

use Chatbox\Chatbox\Schema\SchemaContainer;

class Mapper{

    /**
     * @var SchemaContainer
     */
    private $schemaContainer;

    function __construct(SchemaContainer $schemaContainer)
    {
        $this->schemaContainer = $schemaContainer;
    }

    ## region room

    public function getRoomById($roomId){
        return
    }

    ## endregion




}