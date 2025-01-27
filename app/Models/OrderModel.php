<?php

namespace App\Models;

use Core\Model;

class OrderModel extends Model
{
    public function getOrder($orderId)
    {
       return db()->query("SELECT o.id, o.user_id, u.name AS customer_name, o.is_paid FROM Orders o JOIN Users u ON o.user_id = u.id WHERE o.id = (?)", [$orderId])->getOne();
    }

    public function getGoods($orderId)
    {
       return db()->query("SELECT b.order_id, g.id, g.name, g.price, g.article, b.quantity FROM Goods g JOIN Baskets b ON b.good_id = g.id WHERE b.order_id = (?)", [$orderId])->get();
    }
}