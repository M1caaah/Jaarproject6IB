<?php

namespace app\models;

use app\core\DbModel;

class DashProducts extends DbModel
{
    public string $product_id = '';
    public string $productName = '';
    public string $description = '';
    public string $imagePath = '';
    public string $price = '';


    public static function tableName(): string
    {
        return 'tblproducts';
    }
    public static function primaryKey(): string
    {
        return 'product_id';
    }

    public function attributes(): array
    {
        return ['productName', 'description', 'imagePath', 'price'];
    }

    public function datatypes(): string
    {
        return 'ssss';
    }

    public function labels(): array
    {
        return [
            'productName' => 'Product Name',
            'description' => 'Description',
            'price' => 'Price'
        ];
    }

    public function rules(): array
    {
        return [
            'productName' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
            'imagePath' => [self::RULE_FILE_REQUIRED]
        ];
    }

    public function save()
    {

    }

}