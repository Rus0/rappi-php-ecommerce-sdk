<?php
$classes = array(
    __DIR__ . '/src/Ecommerce.php',
    __DIR__ . '/src/Data/Data.php',
    __DIR__ . '/src/Data/Discount.php',
    __DIR__ . '/src/Data/File.php',
    __DIR__ . '/src/Data/Inventory.php',
    __DIR__ . '/src/Data/Product.php',
    __DIR__ . '/src/Data/Stock.php',
    __DIR__ . '/src/Data/Store.php',
    __DIR__ . '/src/Data/Variation.php',
    __DIR__ . '/src/Data/VariationStock.php'
);
foreach ($classes as $class) {
    require_once $class;
}