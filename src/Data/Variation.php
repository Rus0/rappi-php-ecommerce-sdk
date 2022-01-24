<?php

namespace Rappi\Data;

use stdClass;

class Variation extends Data
{
    protected $type = "";
    protected $label = "";
    protected $value = "";

    /**
     * Variation constructor.
     * @param string $type
     * @param string $label
     * @param string $value
     */
    public function __construct($type = "", $label = "", $value = "")
    {
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * @return stdClass
     */
    public function getData() {
        $data = new stdClass();
        $data->type = $this->getType();
        $data->label = $this->getLabel();
        $data->value = $this->getValue();
        return $data;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}