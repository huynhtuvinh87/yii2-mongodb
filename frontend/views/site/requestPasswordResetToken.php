<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$this->title = 'Yêu cầu đặt lại mật khẩu';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="clearfix job-bg user-page" style="background-size: 100%;">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->			
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <h2><?= $this->title ?></h2>
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                       <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(FALSE) ?>

                    <?= Html::submitButton('Gửi', ['class' => 'btn']) ?>

                    <?php ActiveForm::end(); ?>
                    <?= Alert::widget()?>
                </div>
            </div>
        </div>
    </div>
</section>
