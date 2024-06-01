<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
?>

<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля для регистрации:</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput(['autofocus' => true])->label('Логин') ?>

    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

    <?= $form->field($model, 'fio')->textInput()->label('Фио') ?>

    <?= $form->field($model, 'tel')->textInput()->label('Телефон') ?>

    <?= $form->field($model, 'email')->textInput()->label('Email') ?>

    <div class="form-group">
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>