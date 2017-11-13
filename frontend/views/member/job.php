<?php

use yii\widgets\ListView;
use common\widgets\Alert;
?>
<section class=" job-bg page  ad-profile-page">
    <div class="container">
        <?= \frontend\widgets\MemberMenu::widget() ?>
        <?= Alert::widget() ?>
        <div class="section trending-ads latest-jobs-ads">
            <h4>Công việc của bạn <small>(<?= $count ?>)</small></h4>
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
