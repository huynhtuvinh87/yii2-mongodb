<?php

use yii\widgets\ListView;

$this->title = 'Danh sách công việc';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="job-bg page job-list-page">
    <div class="container">
        <?= $this->render('/layouts/breadcrumb') ?>
        <div class="category-info">	
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <?= \frontend\widgets\FilterJob::widget() ?>
                </div><!-- accordion-->

                <!-- recommended-ads -->
                <div class="col-sm-8 col-md-9">		
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options'      => [
                            'tag'   => 'div',
                            'class' => 'section job-list-item',
                            'id'    => 'list-wrapper',
                        ],
                        'layout'       => "<div class=\"featured-top\"><h4>{summary}</h4></div><div class='job-ad-item'>{items}</div><div class='text-align'>{pager}</div>",
                        'emptyText'    => '<div class="col-xs-12">Nothing added yet.</div>',
                        'itemView'     => '_item',
                        'itemOptions'  => [
                            'tag' => false,
                        ],
                    ])
                    ?>
                </div><!-- recommended-ads -->

            </div>	
        </div>
    </div><!-- container -->
</section><!-- main -->

