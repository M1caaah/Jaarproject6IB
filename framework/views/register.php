<?php

/** @var $model \app\models\User */

use app\core\form\Form;

$form = new Form();
?>
<h1 class="mt-5 ms-5">Register view</h1>

<div class="container w-25">
    <?php Form::begin('', 'post'); ?>

        <div class="row">
            <div class="col"><?php echo $form->field($model, 'firstname') ?></div>
            <div class="col"><?php echo $form->field($model, 'lastname') ?></div>
        </div>
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'birthdate')->dateField(); ?>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <?php echo $form->field($model, 'confirmPassword')->passwordField(); ?>


        <button type="submit" class="btn btn-primary btn-block">Register</button>

    <?php Form::end(); ?>
</div>