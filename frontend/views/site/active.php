<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */


$this->title = 'Đăng ký thành công';
?>


<section class="clearfix job-bg user-page" style="background-size: 100%">
    <div class="container">
        <div class="row">
            <!-- user-login -->			
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <p>Xin chào, <?= $data->name ?></p>
                    <p>
                        <?= $data->status ? "Tài khoản của bạn đã được kích hoạt" : "Cảm ơn bạn đã đăng ký tại website chúng tôi, vui lòng check mail để kích hoạt tài khoản." ?>

                    </p>
                    <p>Support Vndeed,</p>


                </div>
            </div><!-- user-login -->			
        </div><!-- row -->	
    </div><!-- container -->
</section><!-- signin-page -->
