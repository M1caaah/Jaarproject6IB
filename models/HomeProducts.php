<?php

namespace app\models;

use app\core\DbModel;

class HomeProducts extends DbModel
{
    public int $product_id;
    public string $productName;
    public string $description;
    public float $price;
    public string $imagePath;

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
        return ['productName', 'price', 'description', 'imagePath'];
    }

    public function datatypes(): string
    {
        return 'ssss';
    }

    public function labels(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }

    public function getAllProducts()
    {
        return $this->select(['*']);
    }

    public function getProduct()
    {
        return $this->findOne(['product_id' => $this->product_id]);
    }
}