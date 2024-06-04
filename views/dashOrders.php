<?php

    use app\Models\DashOrders;
    /** @var $model DashOrders */

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="my-3">
            <h4>View Orders</h4>
        </div>
        <?php $active = $model->active ? 'inactive' : 'active'; ?>
        <div class="my-3">
            <a href="/dashboard/orders?active=<?= $model->active ? 0 : 1 ?>" class="btn btn-primary">View <?= $active ?> orders</a>
        </div>
        <div class="row">
        <?php if($active = $model->active): ?>
            <?php $orders = $model->findAllOrders(true) ?>
            <?php foreach ($orders as $order): ?>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="fw-bold card-title text-secondary mb-3">Order ID: <?= $order['order_id'] ?></h5>
                            <p class="card-text fs-6">
                                <b>Order Date: </b> <?= $order['date'] ?>
                                <br>
                                <b>Client Name: </b><?= $order['clientName'] ?>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Item Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($order['items'] as $item): ?>
                                        <tr>
                                            <td><?= $item['product_id'] ?></td>
                                            <td><?= $item['productName'] ?></td>
                                            <td><?= $item['price'] ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= $item['quantity'] * $item['price'] ?></td>
                                            <!-- Add more cells as needed -->
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="card-text h5"><b>Order Total: </b> &euro;<?= $order['total'] ?></p>
                                <a href="/dashboard/orders/delete?order_id=<?= $order['order_id'] ?>" class="btn btn-primary ">Delete order</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php $orders = $model->findAllOrders(false) ?>
            <?php foreach ($orders as $order): ?>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="fw-bold card-title text-secondary mb-3">Order ID: <?= $order['order_id'] ?></h5>
                            <p class="card-text fs-6">
                                <b>Order Date: </b> <?= $order['date'] ?>
                                <br>
                                <b>Client Name: </b><?= $order['clientName'] ?>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Item Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($order['items'] as $item): ?>
                                        <tr>
                                            <td><?= $item['product_id'] ?></td>
                                            <td><?= $item['productName'] ?></td>
                                            <td><?= $item['price'] ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= $item['quantity'] * $item['price'] ?></td>
                                            <!-- Add more cells as needed -->
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="card-text h5"><b>Order Total: </b> &euro;<?= $order['total'] ?></p>
                                <a href="/dashboard/orders/activate?order_id=<?= $order['order_id'] ?>" class="btn btn-primary ">Activate order</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>