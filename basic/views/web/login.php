<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
                <h1>Login</h1>

                <?= $form->field($model, 'studentId') ?>
                <?= $form->field($model, 'password') ?>
                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end() ?>

