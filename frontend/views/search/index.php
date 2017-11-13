<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<?php
\Yii::$app->view->registerMetaTag([
    'name'    => 'description',
    'content' => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam: mua bán nhà đất, cho thuê nhà đất, văn phòng, căn hộ, biệt thự, cổng thông tin việc làm, việc làm lập trình php, việc làm lập trình mobile, thông tin công ty, địa chỉ công ty'
]);
\Yii::$app->view->registerMetaTag([
    'name'    => 'keywords',
    'content' => 'cho thuê, mua bán, nhà đất, cho thuê, cần thuê, cần mua, cần bán, bất động sản, việc làm, công ty, php, việc làm php, mobile, ios, android...'
]);
\Yii::$app->view->registerMetaTag([
    'name'    => 'author',
    'content' => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam'
]);
\Yii::$app->view->registerMetaTag([
    'name'    => 'web_author',
    'content' => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:locale',
    'content'  => 'vi_VN'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:type',
    'content'  => 'website'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content'  => 'Bất động sản | việc làm | Thông tin công ty'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content'  => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam: mua bán nhà đất, cho thuê nhà đất, văn phòng, căn hộ, biệt thự, cổng thông tin việc làm, việc làm lập trình php, việc làm lập trình mobile, thông tin công ty, địa chỉ công ty'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content'  => 'http://vndeep.com'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:site_name',
    'content'  => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam'
]);
\Yii::$app->view->registerLinkTag([
    'rel'     => 'canonical',
    'content' => 'http://vndeep.com'
]);
\Yii::$app->view->registerLinkTag([
    'rel'      => 'alternate',
    'hreflang' => 'vi-vn',
    'content'  => 'http://vndeep.com'
]);
?>
<div id="columns" class="columns-container">
    <div class="bg-top"></div>
    <div class="warpper">

        <!-- container -->
        <div class="container">
            <div id="block-search" class="block-search">
                <?= \frontend\widgets\SearchWidget::widget() ?>
            </div>
            <div class="job-search-all" style="margin-top: 30px;">
                <div class="job-search-title">
                    <h4 class="title_block"><?= \Yii::t('app', 'We found {n} results that are available to you', ['n' => '<span>' . number_format($dataProvider->getTotalCount(), 0, ',', '.') . '</span>']); ?></h4>
                </div>
                <div class="job-list" id="job-list">
                    <?php
                    Pjax::begin([
                        'id' => 'pjax_gridview_search',
                    ])
                    ?>

                    <?php
                    if ($type == 'company')
                    {
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'options'      => [
                                'tag'   => 'div',
                                'class' => ' job-listnormal',
                                'id'    => 'list-wrapper',
                            ],
                            'layout'       => "{items}\n<div class='col-sm-12 pagination-page'>{pager}</div>",
                            'itemView'     => '_company',
                        ]);
                    } elseif ($type == 'job')
                    {
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'options'      => [
                                'tag'   => 'div',
                                'class' => ' job-listnormal',
                                'id'    => 'list-wrapper',
                            ],
                            'layout'       => "{items}\n<div class='col-sm-12 pagination-page'>{pager}</div>",
                            'itemView'     => '_job',
                        ]);
                    } elseif ($type == 'realestate')
                    {
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'options'      => [
                                'tag'   => 'div',
                                'class' => ' job-listnormal',
                                'id'    => 'list-wrapper',
                            ],
                            'layout'       => "{items}\n<div class='col-sm-12 pagination-page'>{pager}</div>",
                            'itemView'     => '_realestate',
                        ]);
                    }
                    ?>
                    <?php Pjax::end() ?> 
                </div><!-- end job-list -->
            </div>
        </div> <!-- end container -->
    </div><!-- end warpper -->
    <div class="bg-bottom"></div>
</div><!--end warp-->
<?= $this->registerJs("
$(document).on('click', '.job-name a', function (event){
        window.open($(this).attr('data-href'),'_blank');
    });
") ?>
<?= $this->registerCss("
   .job-item{
        display: block;
    }
    .block-search form{
        margin-top: 0
    }
") ?>