<?php


namespace Rappi\Data;


class Inventory extends Data
{
    /**
     * @var string
     */
    private $storeId;
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $ean;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $trademark;
    /**
     * @var string
     */
    private $categoryFirstLevel;
    /**
     * @var string
     */
    private $categorySecondLevel;
    /**
     * @var string
     */
    private $price;
    /**
     * @var int
     */
    private $discountPrice;
    /**
     * @var int
     */
    private $stock;
    /**
     * @var false
     */
    private $isAvailable;
    /**
     * @var string
     */
    private $saleType;
    /**
     * @var string
     */
    private $imageUrl;
    /**
     * @var false
     */
    private $isDiscontinued;
    /**
     * @var int
     */
    private $quantity;
    /**
     * @var string
     */
    private $unitType;
    /**
     * @var string
     */
    private $minQuantityInGrams;
    /**
     * @var string
     */
    private $stepQuantityInGrams;
    /**
     * @var false
     */
    private $ageRestriction;
    /**
     * @var false
     */
    private $hasAntismoking;
    /**
     * @var false
     */
    private $requiresMedicalPrescription;
    /**
     * @var false
     */
    private $identificationRequired;
    /**
     * @var string
     */
    private $toppingName;

    /**
     * Inventory constructor.
     * @param string $storeId
     * @param string $id
     * @param string $ean
     * @param string $name
     * @param string $description
     * @param string $trademark
     * @param string $categoryFirstLevel
     * @param string $categorySecondLevel
     * @param string $price
     * @param int $discountPrice
     * @param int $stock
     * @param bool $isAvailable
     * @param string $saleType
     * @param string $imageUrl
     * @param bool $isDiscontinued
     * @param int $quantity
     * @param string $unitType
     * @param string $minQuantityInGrams
     * @param string $stepQuantityInGrams
     * @param bool $ageRestriction
     * @param bool $hasAntismoking
     * @param bool $requiresMedicalPrescription
     * @param bool $identificationRequired
     * @param string $toppingName
     */
    public function __construct(
        $storeId = "",
        $id = "",
        $ean = "",
        $name = "",
        $description = "",
        $trademark = "",
        $categoryFirstLevel = "",
        $categorySecondLevel = "",
        $price = "",
        $discountPrice = 0,
        $stock = 0,
        $isAvailable = false,
        $saleType = "",
        $imageUrl = "",
        $isDiscontinued = false,
        $quantity = 0,
        $unitType = "",
        $minQuantityInGrams = "",
        $stepQuantityInGrams = "",
        $ageRestriction = false,
        $hasAntismoking = false,
        $requiresMedicalPrescription = false,
        $identificationRequired = false,
        $toppingName = ""
    ) {
        $this->storeId = $storeId;
        $this->id = $id;
        $this->ean = $ean;
        $this->name = $name;
        $this->description = $description;
        $this->trademark = $trademark;
        $this->categoryFirstLevel = $categoryFirstLevel;
        $this->categorySecondLevel = $categorySecondLevel;
        $this->price = $price;
        $this->discountPrice = $discountPrice;
        $this->stock = $stock;
        $this->isAvailable = $isAvailable;
        $this->saleType = $saleType;
        $this->imageUrl = $imageUrl;
        $this->isDiscontinued = $isDiscontinued;
        $this->quantity = $quantity;
        $this->unitType = $unitType;
        $this->minQuantityInGrams = $minQuantityInGrams;
        $this->stepQuantityInGrams = $stepQuantityInGrams;
        $this->ageRestriction = $ageRestriction;
        $this->hasAntismoking = $hasAntismoking;
        $this->requiresMedicalPrescription = $requiresMedicalPrescription;
        $this->identificationRequired = $identificationRequired;
        $this->toppingName = $toppingName;
    }

    public function getData()
    {
        $data = [];

        $data["store_id"] = $this->getStoreId();
        $data["id"] = $this->getId();
        $data["ean"] = $this->getEan();
        $data["name"] = $this->getName();
        $data["description"] = $this->getDescription();
        $data["trademark"] = $this->getTrademark();
        $data["category_first_level"] = $this->getCategoryFirstLevel();
        $data["category_second_level"] = $this->getCategorySecondLevel();
        $data["price"] = $this->getPrice();
        $data["stock"] = $this->getStock();
        $data["is_available"] = $this->getIsAvailable();
        $data["sale_type"] = $this->getSaleType();

        if($this->getDiscountPrice() > 0) {
            $data["discount_price"] = $this->getDiscountPrice();
        }
        
        if($this->getImageUrl() != "") {
            $data["image_url"] = $this->getImageUrl();
        }

        if($this->getIsDiscontinued()) {
            $data["is_discontinued"] = $this->getIsDiscontinued();
        }

        if($this->getQuantity() > 0) {
            $data["quantity"] = $this->getQuantity();
        }

        if($this->getUnitType() != "") {
            $data["unit_type"] = $this->getUnitType();
        }

        if($this->getMinQuantityInGrams() > 0) {
            $data["min_quantity_in_grams"] = $this->getMinQuantityInGrams();
        }

        if($this->getStepQuantityInGrams() > 0) {
            $data["step_quantity_in_grams"] = $this->getStepQuantityInGrams();
        }

        if($this->getAgeRestriction()) {
            $data["age_restriction"] = $this->getAgeRestriction();
        }

        if($this->getHasAntismoking()) {
            $data["has_antismoking"] = $this->getHasAntismoking();
        }

        if($this->getRequiresMedicalPrescription()) {
            $data["requires_medical_prescription"] = $this->getRequiresMedicalPrescription();
        }

        if($this->getIdentificationRequired()) {
            $data["identification_required"] = $this->getIdentificationRequired();
        }

        if($this->getToppingName() != "") {
            $data["topping Name"] = $this->getUnitType();
        }
        
        return $data;

    }

    /**
     * @return string
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param string $storeId
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     * @return $this
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrademark()
    {
        return $this->trademark;
    }

    /**
     * @param string $trademark
     * @return $this
     */
    public function setTrademark($trademark)
    {
        $this->trademark = $trademark;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryFirstLevel()
    {
        return $this->categoryFirstLevel;
    }

    /**
     * @param string $categoryFirstLevel
     * @return $this
     */
    public function setCategoryFirstLevel($categoryFirstLevel)
    {
        $this->categoryFirstLevel = $categoryFirstLevel;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategorySecondLevel()
    {
        return $this->categorySecondLevel;
    }

    /**
     * @param string $categorySecondLevel
     * @return $this
     */
    public function setCategorySecondLevel($categorySecondLevel)
    {
        $this->categorySecondLevel = $categorySecondLevel;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    /**
     * @param string $discountPrice
     * @return $this
     */
    public function setDiscountPrice($discountPrice)
    {
        $this->discountPrice = $discountPrice;
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
     * @return bool
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * @param bool $isAvailable
     * @return $this
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaleType()
    {
        return $this->saleType;
    }

    /**
     * @param string $saleType
     * @return $this
     */
    public function setSaleType($saleType)
    {
        $this->saleType = $saleType;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDiscontinued()
    {
        return $this->isDiscontinued;
    }

    /**
     * @param bool $isDiscontinued
     * @return $this
     */
    public function setIsDiscontinued($isDiscontinued)
    {
        $this->isDiscontinued = $isDiscontinued;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitType()
    {
        return $this->unitType;
    }

    /**
     * @param string $unitType
     * @return $this
     */
    public function setUnitType($unitType)
    {
        $this->unitType = $unitType;
        return $this;
    }

    /**
     * @return string
     */
    public function getMinQuantityInGrams()
    {
        return $this->minQuantityInGrams;
    }

    /**
     * @param string $minQuantityInGrams
     * @return $this
     */
    public function setMinQuantityInGrams($minQuantityInGrams)
    {
        $this->minQuantityInGrams = $minQuantityInGrams;
        return $this;
    }

    /**
     * @return string
     */
    public function getStepQuantityInGrams()
    {
        return $this->stepQuantityInGrams;
    }

    /**
     * @param string $stepQuantityInGrams
     * @return $this
     */
    public function setStepQuantityInGrams($stepQuantityInGrams)
    {
        $this->stepQuantityInGrams = $stepQuantityInGrams;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAgeRestriction()
    {
        return $this->ageRestriction;
    }

    /**
     * @param bool $ageRestriction
     * @return $this
     */
    public function setAgeRestriction($ageRestriction)
    {
        $this->ageRestriction = $ageRestriction;
        return $this;
    }

    /**
     * @return bool
     */
    public function getHasAntismoking()
    {
        return $this->hasAntismoking;
    }

    /**
     * @param bool $hasAntismoking
     * @return $this
     */
    public function setHasAntismoking($hasAntismoking)
    {
        $this->hasAntismoking = $hasAntismoking;
        return $this;
    }

    /**
     * @return bool
     */
    public function getRequiresMedicalPrescription()
    {
        return $this->requiresMedicalPrescription;
    }

    /**
     * @param bool $requiresMedicalPrescription
     * @return $this
     */
    public function setRequiresMedicalPrescription($requiresMedicalPrescription)
    {
        $this->requiresMedicalPrescription = $requiresMedicalPrescription;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIdentificationRequired()
    {
        return $this->identificationRequired;
    }

    /**
     * @param bool $identificationRequired
     * @return $this
     */
    public function setIdentificationRequired($identificationRequired)
    {
        $this->identificationRequired = $identificationRequired;
        return $this;
    }

    /**
     * @return string
     */
    public function getToppingName()
    {
        return $this->toppingName;
    }

    /**
     * @param string $toppingName
     * @return $this
     */
    public function setToppingName($toppingName)
    {
        $this->toppingName = $toppingName;
        return $this;
    }



}