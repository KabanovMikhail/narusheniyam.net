<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Панель администратора';
?>

<div class="site-statements d-flex flex-column container-fluid">
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

                        <?php
                        if($item->status_id==1) {
                          $form = ActiveForm::begin();
                          echo $form->field($model, 'statement_id')->hiddenInput(['value' => $item->statement_id])->label(false);
                        $items = [
                            '2' => 'Подтверждено',
                            '3'=>'Отклонено'
                        ];
                        echo $form->field($model, 'status_id')->dropDownList($items)->label('Выберите статус заявления');
                        
                        echo Html::submitButton('Сменить статус', ['class' => 'btn btn-primary']);
                        
                        ActiveForm::end();
                      }
                        ?>
                    </div>
            </div>
        </div>  
    <?php endforeach; ?>
</div>