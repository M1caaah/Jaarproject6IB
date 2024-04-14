<?php

namespace app\models;

use app\core\DbModel;

class CartItem extends DbModel
{
    public int $cart_item_id;
    public int $cart_id;
    public int $product_id;
    public int $quantity;


    public static function tableName(): string
    {
        return 'tblcart_item';
    }

    public static function primaryKey(): string
    {
        return 'cart_item_id';
    }

    public function attributes(): array
    {
        return ['cart_id', 'product_id', 'quantity'];
    }

    public function datatypes(): string
    {
        return 'iii';
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