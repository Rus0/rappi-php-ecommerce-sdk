<?php


namespace Rappi\Data;


class Stock extends Data
{

    private $storeId = 0;
    private $productSku = "";
    private $stock = 0;
    private $unitPrice = 0;
    private $enabled = false;
    /**
     * @var Discount[]
     */
    private $discounts = [];
    /**
     * @var Variation[]
     */
    private $variations = [];

    /**
     * Stock constructor.
     * @param int $storeId
     * @param string $productSku
     * @param int $stock
     * @param int $unitPrice
     * @param false $enabled
     * @param array $discounts
     * @param array $variations
     */
    public function __construct(
        $storeId = 0,
        $productSku = "",
        $stock = 0,
        $unitPrice = 0,
        $enabled = false,
        $discounts = [],
        $variations = []
    ) {
        $this->storeId = $storeId;
        $this->productSku = $productSku;
        $this->stock = $stock;
        $this->unitPrice = $unitPrice;
        $this->enabled = $enabled;
        $this->discounts = $discounts;
        $this->variations = $variations;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = [
            "store_id" => $this->getStoreId(),
            "product_sku" => $this->getProductSku(),
            "stock" => $this->getStock(),
            "unit_price" => $this->getUnitPrice(),
            "enagled" => $this->isEnabled(),
            "discounts" => [],
            "variations" => []
        ];

        if(count($this->getVariations()) > 0) {
            $variations = [];
            foreach ($this->getVariations() as $variation) {
                $variations[] = $variation->getData();
            }
            $data["variations"] = $variations;
        }

        if(count($this->getDiscounts()) > 0) {
            $discounts = [];
            foreach ($this->getDiscounts() as $discount) {
                $discounts[] = $discount->getData();
            }
            $data["discounts"] = $discounts;
        }
        return $data;
    }

    /**
     * @param $variationValue
     * @param $stock
     * @param $priceDelta
     * @return Stock
     */
    public function addVariation($variationValue, $stock, $priceDelta) {
        $variation = new VariationStock($variationValue, $stock, $priceDelta);
        $this->variations[] = $variation;
        return $this;
    }

    public function addDiscount($discountType, $value, $beginDate, $endDate) {
        $discount = new Discount($discountType, $value, $beginDate, $endDate);
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductSku()
    {
        return $this->productSku;
    }

    /**
     * @param string $productSku
     * @return $this
     */
    public function setProductSku($productSku)
    {
        $this->productSku = $productSku;
        return $this;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return $this
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param int $unitPrice
     * @return $this
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return array
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * @param array $discounts
     * @return $this
     */
    public function setDiscounts($discounts)
    {
        $this->discounts = $discounts;
        return $this;
    }

    /**
     * @return array
     */
    public function getVariations()
    {
        return $this->variations;
    }

    /**
     * @param array $variations
     * @return $this
     */
    public function setVariations($variations)
    {
        $this->variations = $variations;
        return $this;
    }


}