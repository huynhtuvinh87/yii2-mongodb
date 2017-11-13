<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Cấu hình';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-form">

    <?php
    $form = ActiveForm::begin();
    ?>  

    <div class="row">
        <div class="col-md-3">
            <div class="x_title">
                Thêm
            </div>
            <div class="x_panel">

                <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'value')->textarea(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea() ?>
            </div>


        </div>
        <div class="col-md-9">
            <div class="x_title" style="overflow: hidden">
                Cấu hình 
                <?= Html::submitButton(\Yii::t('app', 'Cập nhập'), ['class' => 'btn btn-primary pull-right']) ?>

            </div>
            <div class="x_panel">
                <?php
                if (!empty($dataProvider)) {
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'key',
                            [
                                'attribute' => 'value',
                                'format' => 'raw',
                                'value' => function($data) {
                                    return '<textarea class="form-control" name=value[' . $data->id . ']>' . $data->value . '</textarea>';
                                },
                            ],
                            'description',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{delete}',
                            ],
                        ],
                    ]);
                }
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(($model->isNewRecord) ? \Yii::t('app', 'Lưu') : \Yii::t('app', 'Update'), ['class' => ($model->isNewRecord) ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>