<?php

namespace Rappi;

use Exception;
use Rappi\Data\Discount;
use Rappi\Data\File;
use Rappi\Data\Inventory;
use Rappi\Data\Product;
use Rappi\Data\Stock;
use Rappi\Data\Variation;
use Rappi\Data\VariationStock;
use Rappi\Data\Store;

class Ecommerce
{
    const API_ENDPOINT = "/api/ecom-public/v2/";
    const INVENTORY_API = "https://services.grability.rappi.com/api/cpgs-integration/datasets";

    private $endpointUrls = [
        "dev" => "https://microservices.dev.rappi.com",
        "ar" => "https://services.rappi.com.ar",
        "br" => "https://services.rappi.com.br",
        "cl" => "https://services.rappi.cl",
        "co" => "https://services.rappi.com",
        "cr" => "https://services.rappi.co.cr",
        "ec" => "https://services.rappi.com.ec",
        "mx" => "https://services.mxgrability.rappi.com",
        "pe" => "https://services.rappi.pe",
        "uy" => "https://services.rappi.com.uy"
    ];
    private $authUrls = [
        "dev" => "https://rests-integrations-dev.auth0.com/oauth/token",
        "prd" => "https://rests-integrations.auth0.com/oauth/token"
    ];
    private $apiKey = "";
    private $selectedUrl = "dev";
    private $clientId;
    private $clientSecret;
    /**
     * @var string
     */
    private $audience;
    /**
     * @var string
     */
    private $grantType;

    /**
     * Ecommerce constructor.
     * @param $clientId
     * @param $clientSecret
     * @param string $apiKey
     * @param string $selectedUrl
     * @param string $audience
     * @param string $grantType
     */
    public function __construct(
        $clientId,
        $clientSecret,
        $apiKey = "",
        $selectedUrl = "dev",
        $audience = "https://int-public-api-v2/api",
        $grantType = "client_credentials"
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->apiKey = $apiKey;
        $this->selectedUrl = $selectedUrl;
        $this->audience = $audience;
        $this->grantType = $grantType;
    }

    /**
     * @param $storeId
     * @param $productSku
     * @param $stock
     * @param $unitPrice
     * @param $enabled
     * @param $discounts
     * @param $variations
     * @return Stock
     * @throws Exception
     */
    public function assignProductToStoreByData(
        $storeId,
        $productSku,
        $stock,
        $unitPrice,
        $enabled,
        $discounts,
        $variations
    ) {
        $stock = $this->getStockObj($storeId, $productSku, $stock, $unitPrice, $enabled, $discounts, $variations);
        return $this->assignProductToStore($stock);
    }

    /**
     * @param $storeId
     * @param $productSku
     * @param $stock
     * @param $unitPrice
     * @param $enabled
     * @param $discounts
     * @param $variations
     * @return Stock
     * @throws Exception
     */
    public function updateProductStockByData(
        $storeId,
        $productSku,
        $stock,
        $unitPrice,
        $enabled,
        $discounts,
        $variations
    ) {
        $stock = $this->getStockObj($storeId, $productSku, $stock, $unitPrice, $enabled, $discounts, $variations);
        return $this->updateProductStock($stock);
    }

    /**
     * @param int $storeId
     * @param string $productSku
     * @param int $stock
     * @param int $unitPrice
     * @param false $enabled
     * @param array $discounts
     * @param array $variations
     * @return Stock
     */
    public function getStockObj(
        $storeId = 0,
        $productSku = "",
        $stock = 0,
        $unitPrice = 0,
        $enabled = false,
        $discounts = [],
        $variations = []
    ) {
        return new Stock($storeId, $productSku, $stock, $unitPrice, $enabled, $discounts, $variations);
    }

    /**
     * @param $sku
     * @param $name
     * @param $brand
     * @param $categories
     * @param string $customReferenceId
     * @param string $defaultImageUrl
     * @param string $descriptionText
     * @param string $descriptionHtml
     * @param string $shortSummary
     * @param array $images
     * @param array $variations
     * @throws Exception
     */
    public function createProductByData(
        $sku,
        $name,
        $brand,
        $categories,
        $customReferenceId = "",
        $defaultImageUrl = "",
        $descriptionText = "",
        $descriptionHtml = "",
        $shortSummary = "",
        $images = [],
        $variations = []
    ) {
        $product = $this->getProductData(
            $sku,
            $name,
            $brand,
            $categories,
            $customReferenceId,
            $defaultImageUrl,
            $descriptionText,
            $descriptionHtml,
            $shortSummary,
            $images,
            $variations
        );

        $this->createProduct($product);
    }

    /**
     * @param $sku
     * @param $name
     * @param $brand
     * @param $categories
     * @param string $customReferenceId
     * @param string $defaultImageUrl
     * @param string $descriptionText
     * @param string $descriptionHtml
     * @param string $shortSummary
     * @param array $images
     * @param array $variations
     * @throws Exception
     */
    public function updateProductByData(
        $sku,
        $name,
        $brand,
        $categories,
        $customReferenceId = "",
        $defaultImageUrl = "",
        $descriptionText = "",
        $descriptionHtml = "",
        $shortSummary = "",
        $images = [],
        $variations = []
    ) {
        $product = $this->getProductData(
            $sku,
            $name,
            $brand,
            $categories,
            $customReferenceId,
            $defaultImageUrl,
            $descriptionText,
            $descriptionHtml,
            $shortSummary,
            $images,
            $variations
        );

        $this->updateProduct($product);
    }

    /**
     * @param $sku
     * @param $name
     * @param $brand
     * @param $categories
     * @param string $customReferenceId
     * @param string $defaultImageUrl
     * @param string $descriptionText
     * @param string $descriptionHtml
     * @param string $shortSummary
     * @param array $images
     * @param array $variations
     * @return Product
     */
    public function getProductData(
        $sku,
        $name,
        $brand,
        $categories,
        $customReferenceId = "",
        $defaultImageUrl = "",
        $descriptionText = "",
        $descriptionHtml = "",
        $shortSummary = "",
        $images = [],
        $variations = []
    ){
        return new Product(
            $sku,
            $name,
            $brand,
            $categories,
            $customReferenceId,
            $defaultImageUrl,
            $descriptionText,
            $descriptionHtml,
            $shortSummary,
            $images,
            $variations
        );
    }

    /**
     * @return Data\Store[]
     * @throws Exception
     */
    public function getStoreList() {
        $return = $this->executeGet("stores");
        $storeList = [];
        if (!empty($return["stores"]) && is_array($return["stores"])) {
            foreach ($return["stores"] as $store) {
                $storeData = $this->getStoreData($store);
                $storeList[] = $storeData;
            }
        }
        return $storeList;
    }

    /**
     * @param $storeId
     * @return Data\Store
     * @throws Exception
     */
    public function getStore($storeId) {
        $store = $this->executeGet("stores/" . $storeId);

        return $this->getStoreData($store);
    }

    /**
     * @param $getEndpoint
     * @return mixed
     * @throws Exception
     */
    protected function executeGet($getEndpoint) {

        $this->validateApiKey();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->endpointUrls[$this->getSelectedUrl()] . self::API_ENDPOINT . $getEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "api_key: " . $this->getApiKey()
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("Error in Rappi api");
        }
        return json_decode($response, true);

    }

    /**
     * @param $postEndpoint
     * @param $data
     * @return mixed
     * @throws Exception
     */
    protected function executePost($postEndpoint, $data) {

        $this->validateApiKey();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->endpointUrls[$this->getSelectedUrl()] . self::API_ENDPOINT . $postEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "api_key: " . $this->getApiKey(),
                "content-type: application/json",
                "content-length: " . strlen($data)
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("Error in Rappi api");
        }
        return json_decode($response, true);
    }

    /**
     * @param $postEndpoint
     * @param $data
     * @return mixed
     * @throws Exception
     */
    protected function executePut($postEndpoint, $data) {

        $this->validateApiKey();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->endpointUrls[$this->getSelectedUrl()] . self::API_ENDPOINT . $postEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "api_key: " . $this->getApiKey(),
                "content-type: application/json",
                "content-length: " . strlen($data)
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("Error in Rappi api");
        }
        return json_decode($response, true);
    }

    /**
     * @return string
     */
    public function getSelectedUrl()
    {
        return $this->selectedUrl;
    }

    /**
     * @param string $selectedUrl
     */
    public function setSelectedUrl($selectedUrl)
    {
        $this->selectedUrl = $selectedUrl;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param $store
     * @return Data\Store
     */
    public function getStoreData($store)
    {
        $storeData = new Data\Store();
        $storeData->setStoreId($store["store_id"]);
        $storeData->setName($store["name"]);
        $storeData->setAddress($store["address"]);
        $storeData->setLat($store["lat"]);
        $storeData->setLng($store["lng"]);
        $storeData->setEnabled((bool)$store["enabled"]);

        return $storeData;
    }

    /**
     * @param $productData
     * @return Product
     */
    protected function getProductDataFromArray($productData) {

        $product = new Product();
        $product->setSku($productData["sku"]);
        $product->setName($productData["name"]);
        $product->setBrand($productData["brand"]);
        $product->setCategories($productData["categories"]);
        $product->setCustomReferenceId($productData["customReferenceId"]);
        $product->setDefaultImageUrl($productData["defaultImageUrl"]);
        $product->setDescriptionText($productData["descriptionText"]);
        $product->setDescriptionHtml($productData["descriptionHtml"]);
        $product->setShortSummary($productData["shortSummary"]);
        $product->setImages($productData["images"]);

        if(count($productData["variations"]) > 0) {
            foreach ($productData["variations"] as $variationData) {
                $product->addVariation(
                    $variationData["type"],
                    $variationData["label"],
                    $variationData["value"]
                );
            }
        }

        return $product;
    }

    /**
     * @param $stockData
     * @return Stock
     */
    protected function getStockDataFromArray($stockData) {
        $stock = new Stock(
            $stockData["store_id"],
            $stockData["product_sku"],
            $stockData["stock"],
            $stockData["unit_price"],
            $stockData["enabled"]
        );

        $variations =[];
        if(count($stockData["variations"]) > 0) {
            foreach ($stockData["variations"] as $variationData) {
                $stock->addVariation(
                    $variationData["variation_value"],
                    $variationData["stock"],
                    $variationData["price_delta"]
                );
            }
        }
        $stock->setVariations($variations);

        $discounts =[];
        if(count($stockData["discounts"]) > 0) {
            foreach ($stockData["discounts"] as $discountData) {
                $stock->addDiscount(
                    $discountData["discount_type"],
                    $discountData["value"],
                    $discountData["begin_date"],
                    $discountData["end_date"]
                );
            }
        }
        $stock->setDiscounts($discounts);

        return $stock;
    }

    /**
     * @throws Exception
     */
    private function validateApiKey()
    {
        if($this->getApiKey() == "") {
            $apiKey = $this->refreshApiKey();
            if($apiKey == "") {
                throw new Exception("Invalid Api Key.");
            }
            $this->setApiKey($apiKey);
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function refreshApiKey() {
        $authRequest = [
            "client_id" => $this->getClientId(),
            "client_secret" => $this->getClientSecret(),
            "audience" => $this->getAudience(),
            "grant_type" => $this->getGrantType()
        ];

        $authUrl = $this->authUrls["prd"];
        if($this->getSelectedUrl() == "dev") {
            $authUrl = $this->authUrls["dev"];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $authUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($authRequest),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("Error in Rappi api");
        }
        $responseData = json_decode($response, true);

        if(!empty($responseData["error"]) && $responseData["error"] != "") {
            throw new Exception("Error in auth:" . $responseData["error"]);
        }

        return $responseData["access_token"];
    }

    /**
     * @param Product $product
     * @return mixed
     * @throws Exception
     */
    public function createProduct(Product $product)
    {
        $data = $this->executePost("products", $product->createJsonString());

        return $this->getProductDataFromArray($data);
    }

    /**
     * @param int $page
     * @param int $size
     * @return mixed
     * @throws Exception
     */
    public function listProducts($page = 1, $size = 10) {
        $data = $this->executeGet("products?page=$page&size=$size");

        if (!empty($data["products"]) && is_array($data["products"])) {
            $productList = [];
            foreach ($data["products"] as $productData) {
                $product = $this->getProductDataFromArray($productData);
                $productList[] = $product;
            }
            $data["products"] = $productList;
        }

        return $data;
    }

    /**
     * @param $sku
     * @return Product
     * @throws Exception
     */
    public function getProduct($sku) {
        $productData = $this->executeGet("products/$sku");

        return $this->getProductDataFromArray($productData);
    }

    /**
     * @param Product $product
     * @return Product
     * @throws Exception
     */
    public function updateProduct(Product $product)
    {
        $data = $this->executePut("products/" . $product->getSku(), $product->createJsonString());

        return $this->getProductDataFromArray($data);
    }

    /**
     * @param $sku
     * @param Variation[] $variations
     * @return Product
     * @throws Exception
     */
    public function addProductVariations($sku, $variations = [])
    {
        if(!empty($variations) && is_array($variations) && count($variations) > 0) {

            $variationData = [];
            foreach ($variations as $variation) {
                $variationData[] = $variation->getData();
            }
            $variationData = json_encode($variationData);
            $data = $this->executePut(
                "products/$sku/add_variations",
                $variationData
            );
            $product = $this->getProductDataFromArray($data);

        } else {
            $product = $this->getProduct($sku);
        }
        return $product;
    }

    /**
     * @param $sku
     * @param array $images
     * @return Product
     * @throws Exception
     */
    public function addImages($sku, $images = [])
    {
        if(!empty($images) && is_array($images) && count($images) > 0) {

            $imageData = json_encode($images);
            $data = $this->executePut(
                "products/$sku/add_images",
                $imageData
            );
            $product = $this->getProductDataFromArray($data);

        } else {
            $product = $this->getProduct($sku);
        }
        return $product;
    }

    /**
     * @param $sku
     * @param $images
     * @return Product
     * @throws Exception
     */
    public function removeImages($sku, $images = [])
    {
        if(!empty($images) && is_array($images) && count($images) > 0) {

            $imageData = json_encode($images);
            $data = $this->executePut(
                "products/" . $sku . "/remove_images",
                $imageData
            );
            $product = $this->getProductDataFromArray($data);

        } else {
            $product = $this->getProduct($sku);
        }
        return $product;
    }

    /**
     * @param Stock $stock
     * @return Stock
     * @throws Exception
     */
    public function assignProductToStore(Stock $stock)
    {
        $stockData = $stock->createJsonString();

        $data = $this->executePost("product-stock", $stockData);

        return $this->getStockDataFromArray($data);

    }

    /**
     * @param Stock $stock
     * @return Stock
     * @throws Exception
     */
    public function updateProductStock(Stock $stock)
    {
        $stockData = $stock->createJsonString();

        $data = $this->executePut("product-stock", $stockData);

        return $this->getStockDataFromArray($data);

    }

    /**
     * @param $sku
     * @return Stock[]
     * @throws Exception
     */
    public function getStocksByProduct($sku) {
        $data = $this->executeGet("product_stock/$sku/stores");

        $stocks = [];
        foreach ($data as $stockData) {
            $stocks[] = $this->getStockDataFromArray($stockData);;
        }

        return $stocks;
    }

    /**
     * @param $sku
     * @param $storeId
     * @param $enabled
     * @return Stock
     * @throws Exception
     */
    public function changeProductStockStatus($sku, $storeId, $enabled) {

        $stockData = json_encode(["enabled" => $enabled]);

        $data = $this->executePut("product-stock/$storeId/$sku", $stockData);

        return $this->getStockDataFromArray($data);
    }

    /**
     * @param $fileId
     * @return File
     * @throws Exception
     */
    public function getFileUploadStatus($fileId) {
        $data = $this->executeGet("upload-status/$fileId");

        return $this->getFileDataFromArray($data);
    }

    /**
     * @param $fileData
     * @return File
     */
    protected function getFileDataFromArray($fileData)
    {
        return new File(
            $fileData["id"],
            $fileData["fileRows"],
            $fileData["failedProcessedRows"],
            $fileData["name"],
            $fileData["dateCreation"],
            $fileData["dateDownload"],
            $fileData["dateBeginProcess"],
            $fileData["dateProcess"],
            $fileData["state"],
            $fileData["error"]
        );
    }

    /**
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
     * @param false $isAvailable
     * @param string $saleType
     * @param string $imageUrl
     * @param false $isDiscontinued
     * @param int $quantity
     * @param string $unitType
     * @param string $minQuantityInGrams
     * @param string $stepQuantityInGrams
     * @param false $ageRestriction
     * @param false $hasAntismoking
     * @param false $requiresMedicalPrescription
     * @param false $identificationRequired
     * @param string $toppingName
     * @return Inventory
     */
    public function getInventoryObj(
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
        return new Inventory(
            $storeId,
            $id,
            $ean,
            $name,
            $description,
            $trademark,
            $categoryFirstLevel,
            $categorySecondLevel,
            $price,
            $discountPrice,
            $stock,
            $isAvailable,
            $saleType,
            $imageUrl,
            $isDiscontinued,
            $quantity,
            $unitType,
            $minQuantityInGrams,
            $stepQuantityInGrams,
            $ageRestriction,
            $hasAntismoking,
            $requiresMedicalPrescription,
            $identificationRequired,
            $toppingName
        );
    }

    /**
     * @param $type
     * @param Inventory[] $inventories
     * @return mixed
     * @throws Exception
     */
    public function uploadInventory($type, $inventories) {
        $this->validateApiKey();

        $inventoryIntegration = [
            "type" => $type,
            "records" => []
        ];

        $inventoriesData = [];
        foreach ($inventories as $inventory) {
            $inventoriesData[] = $inventory->getData();
        }
        $inventoryIntegration["records"] = $inventoriesData;


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::INVENTORY_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($inventoryIntegration),
            CURLOPT_HTTPHEADER => array(
                "api_key: " . $this->getApiKey(),
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("Error in Rappi api");
        }
        return json_decode($response, true);
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param mixed $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * @param string $audience
     * @return $this
     */
    public function setAudience($audience)
    {
        $this->audience = $audience;
        return $this;
    }

    /**
     * @return string
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @param string $grantType
     * @return $this
     */
    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;
        return $this;
    }


}