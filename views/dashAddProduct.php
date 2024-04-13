<?php

/** @var $model \app\models\DashAddUsers*/

use app\core\form\Form;

$form = new Form();
?>

<section class="py-3">
    <div class="container py-5">
        <div class="row mb-1 mb-lg-2">
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-xl-8">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h2 class="fw-bold">Add new product</h2>
                    </div>
                    <div class="card-body text-center d-flex flex-column align-items-center">
                        <?php Form::begin('', 'post'); ?>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col"><?php echo $form->field($model, 'productName') ?></div>
                                <div class="col"><?php echo $form->field($model, 'price')->numberField(0, 9999999999, 0.01) ?></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col"><?php echo $form->field($model, 'description')->textareaField() ?></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col"><?php echo $form->field($model, 'imagePath')->fileField() ?></div>
                            </div>
                        </div>
                        <div class="mb-3"><button class="btn btn-primary shadow d-block w-100" type="submit">Sign up</button></div>
                        <?php Form::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
