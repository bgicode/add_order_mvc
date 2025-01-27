<h2>Заказ№ <?=$order['id']?></h2>
<div>
    <?php
    if ($order['is_paid'] > 0) {
        echo 'Оплачен';
    } else {
        'Не Оплачен';
    }
    ?>
</div>
<div class="goodsList"><strong class="goodsTitle">Товары:</strong>
    <?php
    foreach ($goods as $good) {
        ?>
        <div class="goodUnit">
            <div><?=$good['name']?></div>
            <div>Артикул: <?=$good['article']?></div>
            <div>Цена: <?=$good['price']?></div>
            <div>Количество: <?=$good['quantity']?></div>
        </div>
        <br>
        <?php
    }
    ?>
</div>
<div>Итоговая сумма: <?=$sumPrice?></div>
<div>Покупатель: <a href="<?=PATH . '/user?user_id=' . $order['user_id']?>"><?=$order['customer_name']?></a></div>
