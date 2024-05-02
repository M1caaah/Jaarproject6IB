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
        $records = $this->select(
            ['o.order_id', 'o.date', 'o.total', 'c.firstname', 'c.lastname', 'p.productName', 'p.product_id', 'oi.quantity', 'oi.price'],
            orderby: "o.order_id ASC",
            tableName: 'tblorders o',
            join: ['tblclients c' => 'o.client_id = c.client_id', 'tblorder_items oi' => 'o.order_id = oi.order_id', 'tblproducts p' => 'oi.product_id = p.product_id'],
            checkActive: false
        );

        $orders = [];
        foreach ($records as $record) {
            $orders[$record['order_id']]['order_id'] = $record['order_id'];
            $orders[$record['order_id']]['date'] = $record['date'];
            $orders[$record['order_id']]['total'] = $record['total'];
            $orders[$record['order_id']]['clientName'] = $record['firstname'] . ' ' . $record['lastname'];
            $orders[$record['order_id']]['items'][] = [
                'product_id' => $record['product_id'],
                'productName' => $record['productName'],
                'quantity' => $record['quantity'],
                'price' => $record['price'],
            ];
        }
        return $orders;
    }

    public function countOrders()
    {
        $orderCount = $this->select(['COUNT(*)'], tableName: 'tblorders', checkActive: false);
        return $orderCount[0]['COUNT(*)'];
    }

    public function countEarnings()
    {
        $earnings = $this->select(['SUM(total)'], tableName: 'tblorders', checkActive: false);
        return $earnings[0]['SUM(total)'];
    }
}