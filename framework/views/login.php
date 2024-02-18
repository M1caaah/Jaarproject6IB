<?php

/** @var $model \app\models\User */

use app\core\form\Form;

$form = new Form();
?>
<h1 class="mt-5 ms-5">Login view</h1>

<div class="container w-25">
    <?php Form::begin('', 'post'); ?>

    <?php echo $form->field($model, 'email'); ?>
    <?php echo $form->field($model, 'password')->passwordField(); ?>

    <button type="submit" class="btn btn-primary btn-block">Register</button>

    <?php Form::end(); ?>
</div>