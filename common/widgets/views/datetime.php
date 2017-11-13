<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\bootstrap\Html;
?>
<div class="row form-group">
    <label class="col-sm-3 label-title"><?= $label ?></label>
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-2">
                <?= Html::dropDownList($model, $name_day, $day, ['class' => 'form-control']) ?>
            </div>
            <div class="col-sm-2">
                <?= Html::dropDownList($model, $name_month, $month, ['class' => 'form-control']) ?>
            </div>
            <div class="col-sm-2">
                <?= Html::dropDownList($model, $name_year, $year, ['class' => 'form-control']) ?>
            </div>
        </div>

    </div>
</div>