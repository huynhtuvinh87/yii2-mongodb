<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<section class=" job-bg page  ad-profile-page">
    <div class="container">
        <?= \frontend\widgets\BossMenu::widget() ?>
        <div class="resume-content">
            <div class="personal-deatils section">
                <div class="icons">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </div>  
                <div class="personal-info">
                    <h3>Thông tin cá nhân</h3>
                    <ul class="address">
                        <li><h5>Họ và Tên </h5> <span>:</span><?= $model->name ?></li>
                        <li><h5>Tên tài khoản </h5> <span>:</span><?= $model->username ?></li>
                        <li><h5>Email </h5> <span>:</span><?= $model->email ?></li>
                        <li><h5>Điện thoại </h5> <span>:</span><?= $model->phone ?></li>
                        <li><h5>Địa chỉ </h5> <span>:</span><?= $model->address ?></li>
                        <li><h5>Tỉnh/Thành </h5> <span>:</span><?= $model->city ?></li>
                        <li><h5>Trạng thái </h5> <span>:</span><?= $model->publish() ?></li>
                    </ul>    	
                </div>                               
            </div><!-- personal-deatils -->	



        </div><!-- resume-content -->						
    </div><!-- container -->
</section><!-- ad-profile-page -->
