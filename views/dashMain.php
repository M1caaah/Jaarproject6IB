<?php

use app\models\DashUsers;
use app\models\DashProducts;
use app\models\DashOrders;

/** @var $dashUsers DashUsers */
/** @var $dashProducts DashProducts */
/** @var $dashOrders DashOrders */

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="my-3">
            <h4>Admin Dashboard</h4>
        </div>
        <div class="row">
           <div class="col-md-3 col-6 mb-4">
                <div class="card border-0">
                    <div class="card-body px-4 py-3 px-md-3">
                        <p class="fw-bold text-primary card-text mb-2">Total users</p>
                        <h5 class="fw-bold card-title mb-3"><?= $dashUsers->countUsers() ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="card border-0">
                    <div class="card-body px-4 py-3 px-md-3">
                        <p class="fw-bold text-primary card-text mb-2">Total Earnings</p>
                        <h5 class="fw-bold card-title mb-3">$ ????</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="card border-0">
                    <div class="card-body px-4 py-3 px-md-3">
                        <p class="fw-bold text-primary card-text mb-2">Total Orders</p>
                        <h5 class="fw-bold card-title mb-3"><?= $dashOrders->countOrders() ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="card border-0">
                    <div class="card-body px-4 py-3 px-md-3">
                        <p class="fw-bold text-primary card-text mb-2">Total Products</p>
                        <h5 class="fw-bold card-title mb-3"><?= $dashProducts->countProducts() ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-0">
                    <div class="card-body">
                        <h5 class="fw-bold card-title text-secondary mb-3">Recent Orders</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>M1cah</td>
                                    <td>$ 78.00</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>John</td>
                                    <td>$ 78.00</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Smith</td>
                                    <td>$ 78.00</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>John</td>
                                    <td>$ 78.00</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Smith</td>
                                    <td>$ 78.00</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-0">
                    <div class="card-body">
                        <h5 class="fw-bold card-title text-secondary mb-3">Recent Users</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Registration Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dashUsers->getRecentUsers() as $user): ?>
                                    <tr>
                                        <td><?= $user['firstname'] . ' ' . $user['lastname'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['roleName'] ?></td>
                                        <td><?= $user['regDate'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</main>