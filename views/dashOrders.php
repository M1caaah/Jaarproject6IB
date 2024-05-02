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
                <p class="card-text fs-5"><b>Order Total: </b> <?= $order['total'] ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
        </div>
    </div>