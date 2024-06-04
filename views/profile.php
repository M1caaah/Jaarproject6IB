<?php

use app\core\Application;
/** @var $model \app\models\Profile */

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
                    <a href="/profile" class="list-group-item active">Account overview</a>
                    <a href="/profile/edit" class="list-group-item">Manage profile</a>
                    <a href="/profile/cart" class="list-group-item">Shopping cart</a>
                    <a href="/profile/orders" class="list-group-item">Your orders</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="container-fluid bg-dark p-5 rounded">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-white">Personal info</h2>
                            <div class="card p-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>First name</h5>
                                            <p><?= $model->firstname ?></p>
                                        </div>
                                        <div class="col-6">
                                            <h5>Last name</h5>
                                            <p><?= $model->lastname ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Email</h5>
                                            <p><?= $model->email ?></p>
                                        </div>
                                        <div class="col-6">
                                            <h5>Birthdate</h5>
                                            <p><?= $model->birthdate ?></p>
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