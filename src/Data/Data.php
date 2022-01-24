<?php


namespace Rappi\Data;


abstract class Data
{


    /**
     * @return false|string
     */
    public function createJsonString() {
        return json_encode($this->getData());
    }

    abstract public function getData();
}