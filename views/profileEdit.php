<?php

use app\core\form\Form;
use app\core\Application;
use app\models\PasswordReset;
use \app\models\Profile;

$form = new Form();

/**
 * @var $model Profile
 * @var $passwordModel PasswordReset
 */


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
                    <a href="/profile/edit" class="list-group-item active">Manage profile</a>
                    <a href="/profile/orders" class="list-group-item">Your orders</a>
                    <a href="/profile/wishlist" class="list-group-item">Wishlist</a>
                    <a href="/profile/basket" class="list-group-item">Shopping basket</a>
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
                                        <div class="col">
                                            <?php Form::begin('', 'post') ?>
                                            <div class="row mb-3">
                                                <div class="col"><?php echo $form->field($model, 'firstname') ?></div>
                                                <div class="col"><?php echo $form->field($model, 'lastname') ?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col"><?php echo $form->field($model, 'email') ?></div>
                                                <div class="col"><?php echo $form->field($model, 'birthdate')->dateField() ?></div>
                                            </div>
                                            <button class="btn btn-primary shadow d-block w-100" name="submit" value="info" type="submit">Update</button>
                                            <?php Form::end() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12">
                            <h2 class="text-white">Reset password</h2>
                            <div class="card p-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <?php Form::begin('', 'post') ?>
                                            <div class="row mb-3">
                                                <div class="col"><?php echo $form->field($passwordModel, 'password')->passwordField() ?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col"><?php echo $form->field($passwordModel, 'newPassword')->passwordField() ?></div>
                                                <div class="col"><?php echo $form->field($passwordModel, 'confirmPassword')->passwordField() ?></div>
                                            </div>
                                            <button class="btn btn-primary shadow d-block w-100" name="submit" value="password" type="submit">Update</button>
                                            <?php Form::end() ?>
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