<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$this->title = 'Đóng tài khoản';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- delete-page -->
<section class="clearfix job-bg delete-page">
    <div class="container">
        <?= \frontend\widgets\MemberMenu::widget() ?>
        <div class="close-account text-center">
            <div class="delete-account section">
                <?php
                $form = ActiveForm::begin();
                ?>
                <?=
                $form->field($model, 'id')->hiddenInput()->label(FALSE)
                ?>
                <?= Alert::widget() ?>
                <h2>Đóng tài khoản của bạn</h2>
                <h4>Bạn có chắc rằng bạn muốn đóng tài khoản của bạn?</h4>
                <button class="btn btn-danger">Đóng tài khoản</button>
                <?php ActiveForm::end(); ?>
            </div>			
        </div>
    </div><!-- container -->
</section><!-- delete-page -->
