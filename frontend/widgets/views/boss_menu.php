<?php

use yii\widgets\Breadcrumbs;
?>
<div class="breadcrumb-section">
    <!-- breadcrumb -->
    <?=
    Breadcrumbs::widget([
        'tag'      => "ol",
        'homeLink' => [
            'label' => 'Trang chủ',
            'url'   => Yii::$app->homeUrl,
        ],
        'links'    => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>						
    <h2 class="title"><?= $this->title ?></h2>
</div><!-- banner -->
<div class="job-profile section">	
    <div class="user-profile">
        <div class="user-images">
            <img src="<?= $model->avatar() ?>" alt="User Images" class="img-responsive" style="max-width:150px">
        </div>
        <div class="user">
            <h2>Xin chào, <a href="#"><?= $model->name ?></a></h2>
            <h5>Hoạt động cách đây: <?= date('d/m/Y h:i', $model->login_at) ?></h5>
        </div>

        <!--        <div class="favorites-user">
                    <div class="my-ads">
                        <a href="applied-job.html">29<small>Apply Job</small></a>
                    </div>
                    <div class="favorites">
                        <a href="bookmark.html">18<small>Favorites</small></a>
                    </div>
                </div>								-->
    </div><!-- user-profile -->

    <ul class="user-menu">
        <li><a href="/boss/profile">Thông tin tài khoản </a></li>
        <li><a href="/boss/update">Cập nhật tài khoản</a></li>
        <li><a href="/job/create">Đăng việc</a></li>
        <li><a href="/boss/job">Danh sách công việc</a></li>
        <li><a href="/boss/jobapply">Công việc đã apply</a></li>
        <li><a href="/boss/member">Danh sách nhân viên</a></li>
    </ul>
</div><!-- ad-profile -->
