<?php


use app\core\form\Form;
use app\models\DashUsers;

$form = new Form();

/* @var $model DashUsers */

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="my-3">
            <h4>Edit user: <?= $model->getDisplayName();?></h4>
        </div>
        <div class="card border-0 p-2">
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