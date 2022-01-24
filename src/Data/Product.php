<?php

namespace Rappi\Data;

class Product extends Data
{
    protected $id = 0;
    protected $enabled = false;
    protected $alternateId = null;
    protected $sku = "";
    protected $name = "";
    protected $brand = "";
    protected $customReferenceId = "";
    protected $defaultImageUrl = "";
    protected $descriptionText = "";
    protected $descriptionHtml = "";
    protected $shortSummary = "";
    protected $categories = [];
    protected $images = [];

    /**
     * @var Variation[]
     */
    protected $variations = [];

    /**
     * Product constructor.
     * @param string $sku
     * @param string $name
     * @param string $brand
     * @param array $categories
     * @param string $customReferenceId
     * @param string $defaultImageUrl
     * @param string $descriptionText
     * @param string $descriptionHtml
     * @param string $shortSummary
     * @param array $images
     * @param array $variations
     */
    public function __construct(
        $sku = "",
        $name = "",
        $brand = "",
        $categories = [],
        $customReferenceId = "",
        $defaultImageUrl = "",
        $descriptionText = "",
        $descriptionHtml = "",
        $shortSummary = "",
        $images = [],
        $variations = []
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->brand = $brand;
        $this->categories = $categories;
        $this->customReferenceId = $customReferenceId;
        $this->defaultImageUrl = $defaultImageUrl;
        $this->descriptionText = $descriptionText;
        $this->descriptionHtml = $descriptionHtml;
        $this->shortSummary = $shortSummary;
        $this->images = $images;
        $this->variations = $variations;
    }

    /**
     * @param string $type
     * @param string $label
     * @param string $value
     * @return $this
     */
    public function addVariation($type = "", $label = "", $value = "") {
        $variation = new Variation($type, $label, $value);
        $this->variations[] = $variation;
        return $this;
    }

    /**
     * @param string $category
     * @return $this
     */
    public function addCategory($category = "") {
        $this->categories[] = $category;
        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function addImage($image = "") {
        $this->images[] = $image;
        return $this;
    }

    /**
     * @return array
     */
    public function getDataAsArray() {
        $data = [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "brand" => $this->getBrand(),
            "categories" => $this->getCategories(),
            "variations" => []
        ];

        if($this->getCustomReferenceId() != "") {
            $data["custom_reference_id"] = $this->getCustomReferenceId();
        }

        if($this->getDefaultImageUrl() != "") {
            $data["default_image_url"] = $this->getDefaultImageUrl();
        }

        if($this->getDescriptionText() != "") {
            $data["description_text"] = $this->getDescriptionText();
        }

        if($this->getDescriptionHtml() != "") {
            $data["description_html"] = $this->getDescriptionHtml();
        }

        if($this->getShortSummary() != "") {
            $data["short_summary"] = $this->getShortSummary();
        }

        if(count($this->getImages()) > 0) {
            $data["images"] = $this->getImages();
        }

        if(count($this->getVariations()) > 0) {
            $variations = [];
            foreach ($this->getVariations() as $variation) {
                $variations[] = $variation->getData();
            }
            $data["variations"] = $variations;
        }
        return $data;

    }

    /**
     * @return false|string
     */
    public function createJsonString() {
        return json_encode($this->getDataAsArray());
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return null
     */
    public function getAlternateId()
    {
        return $this->alternateId;
    }

    /**
     * @param null $alternateId
     * @return $this
     */
    public function setAlternateId($alternateId)
    {
        $this->alternateId = $alternateId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomReferenceId()
    {
        return $this->customReferenceId;
    }

    /**
     * @param string $customReferenceId
     * @return $this
     */
    public function setCustomReferenceId($customReferenceId)
    {
        $this->customReferenceId = $customReferenceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultImageUrl()
    {
        return $this->defaultImageUrl;
    }

    /**
     * @param string $defaultImageUrl
     * @return $this
     */
    public function setDefaultImageUrl($defaultImageUrl)
    {
        $this->defaultImageUrl = $defaultImageUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionText()
    {
        return $this->descriptionText;
    }

    /**
     * @param string $descriptionText
     * @return $this
     */
    public function setDescriptionText($descriptionText)
    {
        $this->descriptionText = $descriptionText;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionHtml()
    {
        return $this->descriptionHtml;
    }

    /**
     * @param string $descriptionHtml
     * @return $this
     */
    public function setDescriptionHtml($descriptionHtml)
    {
        $this->descriptionHtml = $descriptionHtml;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortSummary()
    {
        return $this->shortSummary;
    }

    /**
     * @param string $shortSummary
     * @return $this
     */
    public function setShortSummary($shortSummary)
    {
        $this->shortSummary = $shortSummary;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;
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