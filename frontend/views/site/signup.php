<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\BaseHtml;

$this->title = 'Đăng ký thành viên';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="job-bg user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->			
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account job-user-account">
                    <h2>Đăng ký thành viên</h2>

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Họ và Tên'])->label(FALSE) ?>
                    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Tên đăng nhập'])->label(FALSE) ?>
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(FALSE) ?>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Mật khẩu'])->label(FALSE) ?>
                    <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Nhập lại mật khẩu'])->label(FALSE) ?>
                    <div class="checkbox">
                        <label class="pull-left checked" for="signing">
                            <input type="checkbox" name="agree" id="agree"> Khi tạo tài khoản bạn đồng ý với điều khoản của Vndeep </label>
                    </div><!-- checkbox -->	
                    <button type="submit" class="btn">Đăng ký</button>	
                    <?php ActiveForm::end(); ?>

                </div>
            </div><!-- user-login -->			
        </div><!-- row -->	
    </div><!-- container -->
</section><!-- signup-page -->