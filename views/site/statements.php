<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Заявления';
?>

<div class="site-statements d-flex flex-column container-fluid">

<!-- Button trigger modal -->
<div class="mx-auto mb-5">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Новое заявление
</button>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Новое заявление</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'number')->textInput()->label('Номер транспортного средства') ?>

        <?= $form->field($model, 'description')->textArea()->label('Описание нарушения') ?>

        <?= $form->field($model, 'user_id')->hiddenInput(['value'=> Yii::$app->user->identity->user_id])->label(false); ?>

        
      </div>
      <div class="modal-footer">
        <div class="form-group">
            <?= Html::submitButton('Отправить заявление', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>

        <div class="container-fluid">
            <div class="row g-5">
            <?php foreach ($data as $item): ?>
                <div class="col-12 col-md-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-header">
                        Заявление № <?=$item->statement_id?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?=$item->number?></h5>
                        <p class="card-text"><?=$item->description?></p>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <p><?=$item->created_at?></p>
                        <p><?=$item->statuses->status_name?></p>
                    </div>
            </div>
        </div>  
    <?php endforeach; ?>
</div>