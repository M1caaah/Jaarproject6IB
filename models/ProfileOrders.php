<?php

namespace app\models;

use app\core\DbModel;

class ProfileOrders extends DbModel
{

    public static function tableName(): string
    {
        return 'tblorder_items i, tblproducts p';
    }

    public static function primaryKey(): string
    {
        return 'order_item_id';
    }

    public function attributes(): array
    {
        return ['productName', 'i.price', 'quantity'];
    }

    public function datatypes(): string
    {
        return '';
    }

    public function labels(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }

    public function getOrderItems($order_id)
    {
        return $this->select($this->attributes(), 'order_id = '.$order_id.' AND i.product_id = p.product_id');
    }
}