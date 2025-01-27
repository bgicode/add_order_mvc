<?php

namespace App\Models;

use Core\Model;

class AllOrdersModel extends Model
{

    protected array $fillable = ['userName', 'goodName', 'is_paid','date', 'positions'];

    public function getOrders()
    {
       return db()->query('SELECT * FROM Orders')->getAssoc();
    }

    public function getOrderPrice($orderId)
    {    
        return db()->query("SELECT SUM(g.price * b.quantity) as total_price FROM Goods g JOIN Baskets b ON b.good_id = g.id WHERE b.order_id = (?)", [$orderId])->getOne();
    }

    public function getUsers()
    {
       return db()->query("SELECT id, name FROM Users;")->get();
    }

    public function getGoods()
    {
       return db()->query("SELECT id, name FROM Goods;")->get();
    }

    public function getGood($goodId)
    {
       return db()->query("SELECT id, name, price, article FROM Goods WHERE id = (?);", [$goodId])->getOne();
    }

    public function addPosition()
    {
        return db()->query("SELECT id, name FROM Goods;")->get();
    }

    public function addOrder($data) {
        try {
            db()->beginTransaction();
            db()->query("INSERT INTO Orders (user_id, date, is_paid) values (?,?,?)", [$data['userName'], $data['date'], $data['is_paid']]);
            $newOrderId = db()->getInsertId();
            foreach ($data['positions'] as $position) {
                db()->query('INSERT INTO Baskets (good_id, order_id, quantity) values (?,?,?)', [$position['good_id'], $newOrderId, $position['quantity']]);
            }
            db()->commit();
        } catch (\PDOException $e) {
            db()->rollBack();
            var_dump($e);
        }

    }
}
