<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\components\Constant;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Người tìm việc';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                            'action'  => ['index'],
                            'method'  => 'GET',
                            'options' => [
                                'class' => 'form-inline'
                            ]
                ]);
                ?>
                <?= $form->field($search, 'keywords')->textInput()->label(FALSE) ?>
                <button type="submit" class="btn btn-default" style="margin-top: -5px;"><?= Yii::t('app', 'Search') ?></button>
                <?php ActiveForm::end(); ?>
            </div>

            <?php
            Pjax::begin([
                'id' => 'pjax_gridview_user',
            ])
            ?>
            <?php
            $form = ActiveForm::begin([
                        'id'      => 'userAction',
                        'action'  => ['doaction'],
                        'options' => [
                            'class' => 'form-inline'
                        ]
            ]);
            ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'       => "{pager}\n{items}\n{summary}\n{pager}",
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    [
                        'attribute' => 'Name',
                        'format'    => 'raw',
                        'value'     => function($data)
                        {
                            return $data->name;
                        }
                    ],
                    'email',
                    [
                        'attribute' => 'status',
                        'format'    => 'raw',
                        'value'     => function($data)
                        {
                            return Html::dropDownList('Account[status]', $data->status, Constant::ACCOUNT_STATUS, ['class' => 'form-control', 'disabled' => TRUE, 'style' => 'width:150px']);
                        }
                    ],
                    ['class'    => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons'  => [
                            //view button
                            'update' => function ($url, $model)
                            {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id], [
                                            'title' => 'Xem',
                                ]);
                            },
                        ],
                    ],
                ],
            ]);
            ?>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end() ?> 
        </div>
    </div>
</div>
<?= $this->registerJs("
$(document).ready(function() {
    $('form#userAction button[type=submit]').click(function() {
        return confirm('Rollback deletion of candidate table?');
    });
});
") ?>