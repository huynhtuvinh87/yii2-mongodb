<?php

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
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
<?php
if (!\Yii::$app->user->isGuest)
{
    ?>
    <div class="job-profile section">	
        <div class="user-profile">
            <div class="user-images">
                <img src="<?= $model->avatar() ?>" alt="User Images" class="img-responsive" style="max-width:110px">
            </div>
            <div class="user">
                <h2>Xin chào, <a href="#"><?= $model->name ?></a></h2>
                <h5>Hoạt động cách đây: <?= date('d/m/Y h:i', $model->login_at) ?></h5>
            </div>							
        </div><!-- user-profile -->

        <ul class="user-menu">
            <li><?= Html::a('Thông tin tài khoản', ['manager/profile']) ?></li>
            <li><?= Html::a('Hồ sơ của bạn', ['manager/resume']) ?></li>
            <li><?= Html::a('Đăng việc', ['manager/job/create']) ?></li>
            <li><?= Html::a('Công việc đã đăng', ['manager/job']) ?></li>
            <li><?= Html::a('Công việc đã ứng tuyển', ['manager/job/apply']) ?></li>
            <li><?= Html::a('Công ty của bạn', ['manager/company/index']) ?></li>
        </ul>
    </div><!-- ad-profile -->
    <?php
}
?>