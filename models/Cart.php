<?php

namespace app\models;

use app\core\CartModel;
use app\core\DbModel;

class Cart extends CartModel
{
    public int $cart_id;
    public int $client_id;
    public array $cartItems = [];

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
        $cart = static::findOne(['client_id' => $client_id], false);
        $cart->loadCartItems();
        return $cart;
    }

    public function loadCartItems()
    {
        $items = $this->select(['*'], "cart_id = $this->cart_id", tableName:'tblcart_items', checkActive:false);
        foreach ($items as $item) {
            $cartItem = new CartItem();
            $cartItem->loadData($item);
            $this->cartItems[] = $cartItem;
        }
    }

    public function addToCart($product_id)
    {
        if (count($this->cartItems) > 0) {
            foreach ($this->cartItems as $item) {
                if ($item->product_id == $product_id) {
                    $item->quantity++;
                    $item->update($item->cart_item_id, checkActive:false);
                    return;
                }
            }
        }
        $cartItem = new CartItem();
        $cartItem->cart_id = $this->cart_id;
        $cartItem->product_id = $product_id;
        $cartItem->quantity = 1;
        $cartItem->insert();
    }

    public function getTotal()
    {
        $total = 0.00;
        if (count($this->cartItems) > 0) {
            foreach ($this->cartItems as $item) {
                $product = $item->getProduct();
                $total += $product['price'] * $item->quantity;
            }
        }
        return $total;
    }
}