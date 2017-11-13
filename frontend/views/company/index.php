<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Công ty';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class=" job-bg ad-details-page">
    <div class="container">
        <?= \frontend\widgets\MemberMenu::widget() ?>
        <div class="job-postdetails section">
            <div class="row">

                <div class=" col-xs-12"> 
                    <?php
                    Pjax::begin([
                        'id' => 'pjax_gridview_page',
                    ])
                    ?>
                    <?php
                    $form = ActiveForm::begin([
                                'id'      => 'categoryAction',
                                'action'  => ['doaction'],
                                'options' => [
                                    'class' => 'form-inline'
                                ]
                    ]);
                    ?>
                    <div class="pull-left">
                        <div class="form-group" style="margin-bottom: 5px">
                            <select name="action" class="form-control">
                                <option><?= Yii::t('app', 'Builk Actions') ?></option>
                                <option value="order"><?= Yii::t('app', 'Order') ?></option>
                                <option value="delete"><?= Yii::t('app', 'Delete') ?></option>
                            </select>
                        </div>
                        <button type="submit" id="doaction" class="btn btn-default"><?= Yii::t('app', 'Apply') ?></button>
                        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout'       => "{items}\n{summary}\n{pager}",
                        'columns'      => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'class'         => 'yii\grid\CheckboxColumn',
                                'multiple'      => true,
                                'headerOptions' => ['width' => 10]
                            ],
                            'name',
                            [
                                'class'    => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}'
                            ],
                        ],
                    ]);
                    ?>
                    <?php ActiveForm::end(); ?>
                    <?php Pjax::end() ?> 
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->registerJs("
$(document).ready(function() {
    $('form#categoryAction button[type=submit]').click(function() {
        return confirm('Rollback deletion of candidate table?');
    });
});
") ?>