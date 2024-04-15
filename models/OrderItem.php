<?php

namespace app\models;

use app\core\DbModel;

class OrderItem extends DbModel
{
    public int $order_item_id;
    public int $product_id;
    public int $order_id;
    public int $quantity;
    public string $price;


    public static function tableName(): string
    {
        return 'tblorder_items';
    }

    public static function primaryKey(): string
    {
        return 'order_item_id';
    }

    public function attributes(): array
    {
        return ['product_id', 'order_id', 'quantity', 'price'];
    }

    public function datatypes(): string
    {
        return 'iiid';
    }

    public function labels(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }


}