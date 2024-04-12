<?php

/** @var $model \app\models\User */

use app\core\form\Form;

$form = new Form();
?>
<section class="position-relative py-4 py-xl-5">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Log in</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4">
                            <svg class="bi bi-person" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"></path>
                            </svg>
                        </div>
                        <?php Form::begin('', 'post'); ?>
                            <div class="mb-3"><?php echo $form->field($model, 'email'); ?></div>
                            <div class="mb-3"><?php echo $form->field($model, 'password')->passwordField(); ?></div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Login</button></div>
                        <?php Form::end(); ?>
                        <p class="text-muted">Don't have an acount yet? <a href="/register">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>