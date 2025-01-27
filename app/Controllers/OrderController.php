<?php

namespace App\Controllers;

use App\Models\OrderModel;

class OrderController extends BaseController
{

    public function openOrder()
    {
        $model = new OrderModel();
        $order = $model->getOrder(request()->get('order_id'));
        $goods = $model->getGoods(request()->get('order_id'));
        $sumPrice = 0;
        foreach ($goods as $good) {
            $sumPrice += $good['price'] * $good['quantity'];
        }
        return view('order/openOrder', [
            'order' => $order, 'goods' => $goods, 'sumPrice' => $sumPrice
        ]);
    }

}