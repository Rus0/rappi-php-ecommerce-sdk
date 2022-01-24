<?php


namespace Rappi\Data;


use stdClass;

class Discount extends Data
{

    private $discountType = "";
    private $value = "";
    private $beginDate = "";
    private $endDate = "";

    /**
     * Discount constructor.
     * @param string $discountType
     * @param string $value
     * @param string $beginDate
     * @param string $endDate
     */
    public function __construct($discountType = "", $value = "", $beginDate = "", $endDate = "")
    {
        $this->discountType = $discountType;
        $this->value = $value;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
    }

    /**
     * @return stdClass
     */
    public function getData() {
        $data = new stdClass();
        $data->discount_type = $this->getDiscountType();
        $data->value = $this->getValue();
        $data->begin_date = $this->getBeginDate();
        $data->end_date = $this->getEndDate();
        return $data;
    }

    /**
     * @return string
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }

    /**
     * @param string $discountType
     * @return $this
     */
    public function setDiscountType($discountType)
    {
        $this->discountType = $discountType;
        return $this;
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
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * @param string $beginDate
     * @return $this
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }


}