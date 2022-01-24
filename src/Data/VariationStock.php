<?php

namespace Rappi\Data;

use stdClass;

class VariationStock extends Data
{
    protected $variationValue = "";
    protected $stock = "";
    protected $priceDelta = "";

    /**
     * VariationStock constructor.
     * @param string $variationValue
     * @param string $stock
     * @param string $priceDelta
     */
    public function __construct($variationValue = "", $stock = "", $priceDelta = "")
    {
        $this->variationValue = $variationValue;
        $this->stock = $stock;
        $this->priceDelta = $priceDelta;
    }

    /**
     * @return stdClass
     */
    public function getData() {
        $data = new stdClass();
        $data->variation_value = $this->getVariationValue();
        $data->stock = $this->getStock();
        $data->price_delta = $this->getPriceDelta();
        return $data;
    }

    /**
     * @return string
     */
    public function getVariationValue()
    {
        return $this->variationValue;
    }

    /**
     * @param string $variationValue
     * @return $this
     */
    public function setVariationValue($variationValue)
    {
        $this->variationValue = $variationValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param string $stock
     * @return $this
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriceDelta()
    {
        return $this->priceDelta;
    }

    /**
     * @param string $priceDelta
     * @return $this
     */
    public function setPriceDelta($priceDelta)
    {
        $this->priceDelta = $priceDelta;
        return $this;
    }



}