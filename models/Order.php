<?php

namespace app\models;

use app\core\DbModel;

class Order extends DbModel
{
    public int $order_id;
    public int $client_id;
    public string $date;

    public static function tableName(): string
    {
        return 'tblorders';
    }

    public static function primaryKey(): string
    {
        return 'order_id';
    }

    public function attributes(): array
    {
        return ['client_id', 'total', 'status', 'date'];
    }

    public function datatypes(): string
    {
        return 'idss';
    }

    public function labels(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }

    public function saveOrder(Cart $cart)
    {
        $this->client_id = $cart->client_id;
        $this->total = $cart->getTotal();
        $this->status = 0;
        $this->date = date('Y-m-d');
        $this->insert();
        $this->order_id = self::getRecentInsertID();
        $cartItems = $cart->cartItems;
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->order_id = $this->order_id;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->price = $cartItem->getProduct()['price'];
            $orderItem->insert();
            $cartItem->delete($cartItem->cart_item_id);
        }
    }
}