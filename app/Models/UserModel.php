<?php

namespace App\Models;

use Core\Model;

class UserModel extends Model
{
    public function getUser($userId)
    {
       return db()->query("SELECT id, name ,email, phone FROM Users WHERE id = (?)", [$userId])->getOne();
    }

    public function getOrders($userId)
    {
       return db()->query("SELECT id, is_paid FROM Orders WHERE user_id = (?)", [$userId])->get();
    }

    public function getAllPrice($ordersId)
    {
        $ordersIdString = implode(',', array_map('intval', $ordersId));
        return db()->query("SELECT SUM(g.price * b.quantity) as total_price FROM Goods g JOIN Baskets b ON b.good_id = g.id WHERE b.order_id IN ($ordersIdString)")->getOne();
    }
}