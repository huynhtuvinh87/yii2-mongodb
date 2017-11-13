<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Đăng nhập';
?>
<section class="clearfix job-bg user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->			
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <h2>Đăng nhập</h2>

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(FALSE) ?>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Mật khẩu'])->label(FALSE) ?>

                    <button type="submit" class="btn">Đăng nhập</button>	
                    <?php ActiveForm::end(); ?>
                    <!-- forgot-password -->
                    <div class="user-option">
                        <div class="checkbox pull-left">
                            <label for="logged"><input type="checkbox" name="logged" id="logged"> Nhớ đăng nhập </label>
                        </div>
                        <div class="pull-right forgot-password">

                            <a href="<?= Url::to(['site/requestpassword']) ?>">Quên mật khẩu</a>
                        </div>
                    </div><!-- forgot-password -->
                </div>
                <a href="<?= Url::to(['site/signup']) ?>" class="btn-primary">Đăng ký thành viên</a>
            </div><!-- user-login -->			
        </div><!-- row -->	
    </div><!-- container -->
</section><!-- signin-page -->

