<?php

namespace app\models;

use app\core\DbModel;

class DashOrders extends DbModel
{

    public static function tableName(): string
    {
        return 'tblorders o, tblclients c, tblproducts p, tblorder_items i';
    }

    public static function primaryKey(): string
    {
        return 'o.order_id';
    }

    public function attributes(): array
    {
        return ['c.firstname', 'c.lastname', 'o.order_id', 'o.status', 'p.productName', 'i.quantity', 'i.price'];
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

    public function findAllOrders(): array
    {
        $orders = $this->select(where: 'o.client_id = c.client_id AND o.order_id = i.order_id AND i.product_id = p.product_id');
        return $orders;
    }

    public function countOrders()
    {
        $orderCount = $this->select(['COUNT(*)'], tableName: 'tblorders', checkActive: false);
        return $orderCount[0]['COUNT(*)'];
    }
}