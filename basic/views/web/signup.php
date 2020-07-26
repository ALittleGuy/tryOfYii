<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SignupForm */
/* @var $form ActiveForm */
?>

<div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
                <div class="Signup">
                    <h1>Signup</h1>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => 'please enter your name']) ?>
                    <?= $form->field($model, 'studentId')->textInput(['placeholder' => 'please enter your school ID']) ?>
                    <?= $form->field($model, 'mobile')->textInput(['placeholder' => 'please enter your mobile number']) ?>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'please enter your password']) ?>
                    <?= $form->field($model, 'password_confirm')->passwordInput(['placeholder' => 'verify password']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- Signup -->

