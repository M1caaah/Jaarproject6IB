<?php

use app\core\form\Form;
use app\models\DashUsers;

$form = new Form();

/* @var $model DashUsers */

?>

<section class="py-3">
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-xl-8">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h2>Edit user: <?= $model->getDisplayName();?></h2>
                    </div>

                    <div class="card-body text-center d-flex flex-column align-items-center">
                        <?php Form::begin('', 'post') ?>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col"><?php echo $form->field($model, 'firstname') ?></div>
                                <div class="col"><?php echo $form->field($model, 'lastname') ?></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col"><?php echo $form->field($model, 'email') ?></div>
                                <div class="col"><?php echo $form->field($model, 'birthdate')->dateField() ?></div>
                            </div>
                        </div>
                        <button class="btn btn-primary shadow d-block w-100" name="submit" value="info" type="submit">Update</button>
                        <?php Form::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>