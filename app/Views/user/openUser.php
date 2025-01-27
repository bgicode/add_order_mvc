<?php
if (isset($isUser)) {
    echo '<h2>Покупатель не выбран</h2>';
} else {
    ?>
    <h2>Покупатель</h2>
    <div><?=$user['name']?></div>
    <div><?=$user['phone']?></div>
    <div><?=$user['email']?></div>
    <div class="orderList">Заказы</div>
    <ul>
        <?php
        foreach ($orders as $order) {
            if ($order['is_paid'] > 0) {
                $paidStat = 'Оплачен';
            } else {
                $paidStat = 'Не оплачен';
            }
            ?>
            <li><a href="<?=PATH . '/order?order_id=' . $order['id']?>">Заказ №<?=$order['id']?></a> <?=$paidStat?></li>
            <?php
            }
        ?>
        
    </ul>
    <div>Сумма заказов: <?=$allPrice['total_price']?></div>
<?php
}
