<?php

use app\core\Application;
/** @var $model \app\models\Cart */

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
                    <a href="/profile/cart" class="list-group-item active">Shopping cart</a>
                    <a href="/profile/orders" class="list-group-item">Your orders</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="container-fluid bg-dark p-5 rounded">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-white">Shopping cart</h2>
                            <div class="card p-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <?php if(!empty($model->cartItems)): ?>
                                            <div class="row">
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
                                                    <?php foreach ($model->cartItems as $item) : ?>
                                                        <?php $product = $item->getProduct(); ?>
                                                        <tr>
                                                            <td>
                                                                <?= $product["productName"] ?>
                                                            </td>
                                                            <td>&euro;<?= $product["price"] ?></td>
                                                            <td>
                                                                <a href="/cartchange?cart_item_id=<?= $item->cart_item_id ?>&qc=-1">-</a>
                                                                <?= $item->quantity ?>
                                                                <a href="/cartchange?cart_item_id=<?= $item->cart_item_id ?>&qc=1">+</a>
                                                            </td>
                                                            <td>&euro;<?= $product["price"] * $item->quantity ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <h5>Total:  &euro;<?= $model->getTotal() ?></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="/checkout" class="btn btn-primary shadow d-block w-100">Checkout</a>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                                <h5 class="text-center py-5">Your cart is empty</h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
