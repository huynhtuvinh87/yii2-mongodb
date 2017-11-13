<?php

use yii\widgets\ListView;
use common\widgets\Alert;
$this->title ='Công việc của bạn';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class=" job-bg page  ad-profile-page">
    <div class="container">
        <?= \frontend\widgets\BossMenu::widget() ?>
        <?= Alert::widget() ?>
        <div class="section trending-ads latest-jobs-ads">
            <h4>Danh sách công việc <small>(<?= $count ?>)</small></h4>
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'options'      => [
                    'tag'   => 'div',
                    'class' => 'job-ad-item',
                    'id'    => 'list-wrapper',
                ],
                'layout'       => "{items}\n<div class='col-sm-12 pagination-page'>{pager}</div>",
                'itemView'     => '_list',
            ]);
            ?>


        </div><!-- latest-jobs-ads -->									
    </div><!-- container -->
</section><!-- ad-profile-page -->
