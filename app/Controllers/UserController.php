<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{

    public function openUser()
    {
        $userId = request()->get('user_id');
        $model = new UserModel();
        if (isset($userId)) {
            $user = $model->getUser($userId);
            $orders = $model->getOrders($userId);
            foreach ($orders as $order) {
                $ordersId[] = $order['id'];
            }
            $allPrice = $model->getAllPrice($ordersId);
            return view('user/openUser', [
            'user' => $user,
            'orders' => $orders,
            'allPrice' => $allPrice
            ]);
            
        } else {
            return view('user/openUser', ['isUser' => false]);
        }
        
    }

}