<?php

use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->category['title'], 'url' => Yii::$app->urlManager->createAbsoluteUrl(["category/" . $model->category['slug']])];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="job-bg page job-details-page">
    <div class="container">
        <?= $this->render('/layouts/breadcrumb') ?>
        <?= Alert::widget() ?>
        <div class="job-details">
            <div class="section job-ad-item">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="item-info">
                            <div class="ad-info">
                                <span><a href="#" class="title"><?= $model->title ?></a></span>
                                <div class="ad-meta">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><?= $model->location['title'] ?> </a></li>
                                        <li class="type"><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $model->type ?></a></li>
                                        <li><a href="#"><i class="fa fa-money" aria-hidden="true"></i><?= $model->price ?></a></li>
                                        <li><a href="#"><i class="fa fa-tags" aria-hidden="true"></i><?= $model->category['title'] ?></a></li>
                                    </ul>

                                </div><!-- ad-meta -->									
                            </div><!-- ad-info -->
                        </div><!-- item-info -->
                        <div class="social-media">

                            <ul class="share-social">
                                <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>	
                    </div>

                    <div class="col-sm-2">
                        <div class="social-media pull-right">
                            <div class="button">
                                <?php
                                if (!Yii::$app->user->isGuest)
                                {
                                    if (!$apply->check() && Yii::$app->user->identity->role = "member")
                                    {
                                        ?>
                                        <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#modalApply">Apply</button>
                                        <?php
                                    } elseif (Yii::$app->user->identity->role = "member")
                                    {
                                        ?>
                                        <button type="button" class="btn btn-success pull-right">Đã apply</button>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- job-ad-item -->

            <div class="job-details-info">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="section job-description">
                            <div class="description-info">
                                <h1>Mô tả</h1>
                                <p><?= nl2br($model->description) ?></p>
                            </div>
                            <div class="responsibilities">
                                <h1>Trách nhiệm </h1>
                                <p><?= nl2br($model->responsibilities) ?></p>
                            </div>
                            <div class="requirements">
                                <h1>Yêu cầu</h1>
                                <p><?= nl2br($model->request) ?></p>
                            </div>							
                        </div>							
                    </div>
                    <div class="col-sm-4">
                        <div class="section job-short-info">
                            <h1>Thông tin công việc</h1>

                            <ul>
                                <li><span class="icon"><i class="fa fa-bolt" aria-hidden="true"></i></span>Đã đăng: <?= date('d/m/Y', $model->created_at) ?></li>
                                <li><span class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i></span> Người đăng: <a href="#"><?= $model->user->name ?></a></li>
                                <li><span class="icon"><i class="fa fa-industry" aria-hidden="true"></i></span>Ngành: <a href="#"><?= $model->category['title'] ?></a></li>
                                <li><span class="icon"><i class="fa fa-line-chart" aria-hidden="true"></i></span>Kỹ năng: 
                                    <?php
                                    foreach ($model->programming as $value)
                                    {
                                        $_pro[] = '<a href="">' . $value['title'] . '</a>';
                                    }
                                    echo implode(', ', $_pro);
                                    ?>
                                    <?php
                                    if ($model->framework)
                                    {
                                        foreach ($model->framework as $value)
                                        {
                                            $_pro[] = '<a href="">' . $value['title'] . '</a>';
                                        }
                                        echo ', ' . implode(', ', $_pro);
                                    }
                                    ?>
                                </li>

                            </ul>
                        </div>
                        <div class="section company-info">
                            <h1>Thông tin công ty</h1>
                            <ul>
                                <li>Tên công ty: <a href="#"><?= $model->company['name'] ?></a></li>
                                <li>Địa điểm : <?= $model->company['address'] ?></li>
                                <li>Quy mô công ty:  <?= $model->company['company_size'] ?></li>
                                <li>Điện thoại: <?= $model->company['phone'] ?></li>
                                <li>Email: <a href="#"><?= $model->company['email'] ?></a></li>
                                <li>Website: <a href="#"><?= $model->company['website'] ?></a></li>
                            </ul>								
                        </div>
                    </div>
                </div><!-- row -->					
            </div><!-- job-details-info -->				
        </div><!-- job-details -->
    </div><!-- container -->
</section><!-- job-details-page -->

<section id="something-sell" class="clearfix parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="title">Add your resume and let your next job find you.</h2>
                <h4>Post your Resume for free on <a href="#">Jobs.com</a></h4>
                <a href="post-resume.html" class="btn btn-primary">Add Your Resume</a>
            </div>
        </div><!-- row -->
    </div><!-- contaioner -->
</section><!-- something-sell -->
<div id="modalApply" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Apply</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin(['id' => 'form_job']);
                ?>
                <div class="row form-group">
                    <label class="col-sm-3 control-label">Công việc</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" disabled="" value="<?= $model->title ?>">
                    </div>
                </div>
                <?= $form->field($apply, 'job_id')->hiddenInput(['value' => $model->id])->label(FALSE) ?>

                <?=
                $form->field($apply, 'why_choose_us', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-3 control-label\">" . $apply->getAttributeLabel('why_choose_us') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                ])->textarea()
                ?>
                <?=
                $form->field($apply, 'price', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-3 label-title\">" . $apply->getAttributeLabel('price') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button id="btn_job" type="button" class="btn btn-primary">Đăng</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>
<?=
$this->registerJs('
    $(document).ready(function(){
    $("#btn_job").on("click", function(){
        $("#form_job").submit();
    });
});
        ');
?>
