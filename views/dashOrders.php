<?php

    use app\Models\DashOrders;
    /** @var $model DashOrders */

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="my-3">
            <h4>View Orders</h4>
        </div>
        <div class="row">
            <?php $orders = $model->findAllOrders() ?>
            <?php foreach ($orders as $order) ?>

            <?php endforeach; ?>
        </div>
    </div>