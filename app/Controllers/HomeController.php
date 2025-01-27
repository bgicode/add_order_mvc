<?php

namespace App\Controllers;

use App\Models\AllOrdersModel;
use Core\Model;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new AllOrdersModel();
        
        $orders = $model->getOrders();
        foreach ($orders as $key => $order) {
            $orders[$key]['total_price'] = $model->getOrderPrice($order['id'])['total_price'];
        }

        $users = $model->getUsers();
        $goods = $model->getGoods();
        if (isset($_GET['good_id'])) {  
            $users = $model->getGood(request()->get('good_id'));
            echo(json_encode($users, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK));
        } else {
            return view('allOrders', ['orders' => $orders, 'users' => $users, 'goods' => $goods]);
        }

    }

    public function addOrder()
    {

        $model = new AllOrdersModel();
        $currentDateTime = date('d-m-Y H:i:s');

        $model->loadData();

        $data = $model->attributes;
        $data['date'] = $currentDateTime;
        $model->addOrder($data);

        response()->redirect('/');
    }
}
