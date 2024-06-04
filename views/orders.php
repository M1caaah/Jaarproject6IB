<?php

use app\core\Application;
/** @var $model \app\models\ProfileOrders*/

?>

<main>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1>Welcome <?= Application::$app->user->getDisplayName() ?>!</h1>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-3">
                <div class="list-group fs-5">
                    <a href="/profile" class="list-group-item">Account overview</a>
                    <a href="/profile/edit" class="list-group-item">Manage profile</a>
                    <a href="/profile/cart" class="list-group-item">Shopping cart</a>
                    <a href="/profile/orders" class="list-group-item active">Your orders</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="container-fluid bg-dark p-5 rounded">
                    <?php if($orders = Application::$app->user->getOrders()) : ?>
                    <?php foreach ($orders as $order) : ?>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-white">
                                Order #<?= $order['order_id'] ?> - <?= $order['date'] ?>
                            </h2>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            <h2 class="text-white"></h2>
                            <div class="card p-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-dark table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($model->getOrderItems($order['order_id']) as $item) : ?>
                                                    <tr>
                                                        <td>
                                                            <?= $item['productName'] ?>
                                                        </td>
                                                        <td>&euro;<?= $item['price'] ?></td>
                                                        <td>
                                                            <?= $item['quantity'] ?>
                                                        </td>
                                                        <td>&euro;<?= $item['price'] * $item['quantity'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h5>Total: &euro;<?= $order['total'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <h5 class="text-center py-5">You have no registered orders</h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
