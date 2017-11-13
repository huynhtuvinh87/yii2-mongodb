<?php

use yii\widgets\ListView;

$this->title = 'Giao nhận việc';
?>
<?= \frontend\widgets\SearchWidget::widget() ?>
<div class="page">
    <div class="container">
        <div class="section category-items job-category-items  text-center">
            <?= frontend\widgets\CategoryWidget::widget() ?>			
        </div><!-- category ad -->			

        <div class="section latest-jobs-ads">
            <h4>Công việc mới nhất</h4>
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'options'      => [
                    'tag'   => 'div',
                    'class' => 'job-ad-item',
                    'id'    => 'list-wrapper',
                ],
                'layout'       => "{items}\n<div class='col-sm-12 pagination-page'>{pager}</div>",
                'itemView'     => '/job/_item',
            ]);
            ?>
        </div><!-- trending ads -->		


        <div class="section cta cta-two text-center">
            <div class="row">
                <div class="col-sm-4">
                    <div class="single-cta">
                        <div class="cta-icon icon-jobs">
                            <img src="/theme/images/icon/31.png" alt="Icon" class="img-responsive">
                        </div><!-- cta-icon -->
                        <h3><?= $count_job ?></h3>
                        <h4>Công việc</h4>
                    </div>
                </div><!-- single-cta -->

                <div class="col-sm-4">
                    <div class="single-cta">
                        <!-- cta-icon -->
                        <div class="cta-icon icon-company">
                            <img src="/theme/images/icon/32.png" alt="Icon" class="img-responsive">
                        </div><!-- cta-icon -->
                        <h3><?= $count_company ?></h3>
                        <h4>Công ty</h4>
                    </div>
                </div><!-- single-cta -->

                <div class="col-sm-4">
                    <div class="single-cta">
                        <div class="cta-icon icon-candidate">
                            <img src="/theme/images/icon/33.png" alt="Icon" class="img-responsive">
                        </div><!-- cta-icon -->
                        <h3><?= $count_member ?></h3>
                        <h4>Ứng viên</h4>
                    </div>
                </div><!-- single-cta -->
            </div><!-- row -->
        </div><!-- cta -->			

    </div><!-- conainer -->
</div><!-- page -->

<!-- download -->
<section id="download" class="clearfix parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Download on App Store</h2>
            </div>
        </div><!-- row -->

        <!-- row -->
        <div class="row">
            <!-- download-app -->
            <div class="col-sm-4">
                <a href="#" class="download-app">
                    <img src="/theme/images/icon/16.png" alt="Image" class="img-responsive">
                    <span class="pull-left">
                        <span>available on</span>
                        <strong>Google Play</strong>
                    </span>
                </a>
            </div><!-- download-app -->

            <!-- download-app -->
            <div class="col-sm-4">
                <a href="#" class="download-app">
                    <img src="/theme/images/icon/17.png" alt="Image" class="img-responsive">
                    <span class="pull-left">
                        <span>available on</span>
                        <strong>App Store</strong>
                    </span>
                </a>
            </div><!-- download-app -->

            <!-- download-app -->
            <div class="col-sm-4">
                <a href="#" class="download-app">
                    <img src="/theme/images/icon/18.png" alt="Image" class="img-responsive">
                    <span class="pull-left">
                        <span>available on</span>
                        <strong>Windows Store</strong>
                    </span>
                </a>
            </div><!-- download-app -->
        </div><!-- row -->
    </div><!-- contaioner -->
</section><!-- download -->
