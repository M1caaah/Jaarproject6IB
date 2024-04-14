<?php

namespace app\models;

use app\core\CartModel;
use app\core\DbModel;

class Cart extends CartModel
{
    public int $cart_id;
    public int $client_id;

    public static function tableName(): string
    {
        return 'tblcarts';
    }

    public static function primaryKey(): string
    {
        return 'cart_id';
    }

    public function attributes(): array
    {
        return ['client_id'];
    }

    public function datatypes(): string
    {
        return 'i';
    }

    public function labels(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }

    public static function cartExists($client_id): bool
    {
        $cart = static::findOne(['client_id' => $client_id], false);
        if ($cart) {
            return true;
        }
        return false;
    }

    public static function getCart($client_id)
    {
        if (!static::cartExists($client_id))
        {
            $cart = new Cart();
            $cart->client_id = $client_id;
            $cart->insert();
            return $cart;
        }
        return static::findOne(['client_id' => $client_id], false);
    }

    public function addItem($client_id, $product_id)
    {
        $cart = $this->getCart($client_id);
        $cartItem = new CartItem();
        $cartItem->insert(['cart_id' => $cart->cart_id, 'product_id' => $product_id]);
    }
}