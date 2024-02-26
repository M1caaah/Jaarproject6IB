<?php

/** @var $model \app\models\User */

use app\core\form\Form;

$form = new Form();
?>


    <section class="py-3">
        <div class="container py-5">
            <div class="row mb-1 mb-lg-2">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <p class="fw-bold text-success mb-2">Sign up</p>
                    <h2 class="fw-bold">Welcome</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-xl-8">
                    <div class="card">
                        <div class="card-body text-center d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary shadow bs-icon my-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z">

                                    </path>
                                </svg>
                            </div>
                            <?php Form::begin('', 'post'); ?>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col"><?php echo $form->field($model, 'firstname') ?></div>
                                        <div class="col"><?php echo $form->field($model, 'lastname') ?></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col"><?php echo $form->field($model, 'email'); ?></div>
                                        <div class="col"><?php echo $form->field($model, 'birthdate')->dateField(); ?></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col"><?php echo $form->field($model, 'password')->passwordField(); ?></div>
                                        <div class="col"><?php echo $form->field($model, 'confirmPassword')->passwordField(); ?></div>
                                    </div>
                                </div>
                            <script>
                                console.log(document.getElementsByName('birthdate')[0].value)
                            </script>
                                <div class="mb-3"><button class="btn btn-primary shadow d-block w-100" type="submit">Sign up</button></div>
                                <p class="text-muted">Already have an account?&nbsp;<a href="/login">Log in</a></p>
                            <?php Form::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>