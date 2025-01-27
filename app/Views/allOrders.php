<div>
    <h2>Добавление заказа</h2>
    <form action="<?php base_url($path = '') ?>" method="post">
        <div>
            <div class="selectWraper">
                <label>Покупатель</label>
                <select name="userName">
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '">' . $user['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="positions formGroup">
                <div class="positionsWraper">
                    <div class="fieldWraper positionsUnit allPositions">
                        <div>
                            <div class="selectWraper">
                                <label>Выбор товара</label>
                                <select class="goodName" name="goodName">
                                    <?php
                                    foreach ($goods as $good) {
                                        echo '<option value="' . $good['id'] . '">' . $good['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="inputWraper articleWrapper">
                                <div class="button addPosition">
                                    <div>Добавить товарную позицию</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div>
                <lable class="positionFieldTitle paidTitle">Оплачен
                    <input class="field positionField iaPaid" type="radio" name="is_paid" value="1">
                </lable>
                <lable class="positionFieldTitle paidTitle">Не Оплачен
                    <input class="field positionField iaPaid" type="radio" name="is_paid" value="0">
                </lable>
            </div>

            <input class="input add" type="submit" name="submit" value="Добавить заказ">
        </div>
        <div>
            <h3>Товарные позиции</h3>
            <div class="showPositions">
            </div>
        </div>
    </form>
</div>

<div>
    <h2>Все заказы</h2>
    <?php
    foreach ($orders as $order) {
    ?>
        <div><a href="<?=PATH . '/order?order_id=' . $order['id']?>"><div class="link">Заказ № <?=$order['id']?></div></a> <?=$order['total_price']?></div>
    <?php
    }
    ?>
</div>
