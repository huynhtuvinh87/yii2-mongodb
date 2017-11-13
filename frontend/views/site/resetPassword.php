<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Đặt lại mật khẩu';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="clearfix job-bg user-page" style="background-size: 100%;">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->			
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>Vui lòng chọn mật khẩu mới của bạn:</p>

                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Nhâp mật khẩu mới'])->label(FALSE) ?>

                    <?= Html::submitButton('Lưu', ['class' => 'btn']) ?>


                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
</section>