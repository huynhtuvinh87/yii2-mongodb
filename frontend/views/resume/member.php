<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\widgets\Breadcrumbs;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$this->title = 'Hồ sơ cá nhân';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class=" job-bg page  ad-profile-page">
    <div class="container">
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
        <?= Alert::widget() ?>
        <div class="resume-content">
            <div class="profile section clearfix">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="profile-logo">
                            <img class="img-responsive" src="<?= $model->user->avatar() ?>" alt="Image" style="max-width: 150px">
                        </div>
                        <div class="profile-info">
                            <h1><?= $model->user->name ?></h1>
                            <address>
                                <p>Address: <?= $model->user->address ?> <br> Phone: <?= $model->user->phone ?> <br> Email:<a href="#"> <?= $model->user->email ?></a></p>
                            </address>
                        </div>	
                    </div>
                    <?php
                    if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'boss')
                    {
                        ?>
                        <div class="col-sm-4">
                            <div class="pull-right" style="padding-top: 15%">
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal">Ứng viên</button>
                            </div>
                        </div>

                    <?php }
                    ?>
                </div>
            </div><!-- profile -->

            <div class="career-objective section">
                <div class="icons">
                    <i class="fa fa-black-tie" aria-hidden="true"></i>
                </div>   
                <div class="career-info">
                    <h3>Mục tiêu nghề nghiệp</h3>
                    <p><?= nl2br($model->career_objective) ?></p>
                </div>                                 
            </div><!-- career-objective -->

            <div class="work-history section">
                <div class="icons">
                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                </div>   
                <div class="work-info">
                    <h3>Lịch sử công việc</h3>
                    <ul>
                        <?php
                        if ($model->works)
                        {
                            foreach ($model->works as $value)
                            {
                                ?>
                                <li>
                                    <h4><?= $value['work_company'] ?> @ <?= $value['work_designation'] ?> <span><?= $value['work_time_begin'] ?> - <?= $value['work_time_end'] ?></span></h4>
                                    <p><?= $value['work_description'] ?></p>
                                </li>
                                <?php
                            }
                        }
                        ?>


                    </ul>
                </div>                                 
            </div><!-- work-history -->

            <div class="educational-background section">
                <div class="icons">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                </div>	
                <div class="educational-info">
                    <h3>Học vấn</h3>
                    <ul>
                        <?php
                        if ($model->education)
                        {
                            foreach ($model->education as $value)
                            {
                                ?>
                                <li>
                                    <h4><?= $value['education_institute_name'] ?> @ <?= $value['education_degree'] ?> <span><?= $value['education_time_begin'] ?> - <?= $value['education_time_end'] ?></span></h4>
                                    <p><?= $value['education_description'] ?></p>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>


                </div>				
            </div><!-- educational-background -->

            <div class="special-qualification: section">
                <div class="icons">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                </div>	
                <div class="qualification">
                    <h3>Trình độ chuyên môn</h3>
                    <?= nl2br($model->qualification) ?><br>
                    <p><?= !empty($model->category) ? implode(', ', $model->category) : "" ?><br>
                        <?= !empty($model->programming) ? implode(', ', $model->programming) : "" ?><br>
                    <?= !empty($model->framework) ? implode(', ', $model->framework) : "" ?><p>
                </div>				
            </div><!-- educational-background -->

            <div class="language-proficiency section">
                <div class="icons">
                    <i class="fa fa-language" aria-hidden="true"></i>
                </div>
                <div class="proficiency">
                    <h3>Trình độ ngoại ngữ</h3>
                    <ul class="list-inline">
                        <?php
                        if ($model->language)
                        {
                            foreach ($model->language as $value)
                            {
                                ?>
                                <li>
                                    <h5><?= $value['language_name'] ?></h5>
                                    <?= $value['language_level'] ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div><!-- language-proficiency -->		

            <div class="personal-deatils section">
                <div class="icons">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </div>  
                <div class="personal-info">
                    <h3>Thông tin cá nhân</h3>
                    <ul class="address">
                        <li><h5>Họ và Tên </h5> <span>:</span><?= $model->name ?></li>
                        <li><h5>Họ và Tên (Cha) </h5> <span>:</span><?= $model->father_name ?></li>
                        <li><h5>Họ và Tên (Mẹ) </h5> <span>:</span><?= $model->mother_name ?></li>
                        <li><h5>Ngày sinh </h5> <span>:</span><?= $model->birthday ?></li>
                        <li><h5>Nơi sinh </h5> <span>:</span><?= $model->birth_place ?></li>
                        <li><h5>Quốc tịch </h5> <span>:</span><?= $model->nationality ?></li>
                        <li><h5>Giới tính </h5> <span>:</span><?= $model->gender == 1 ? 'Nam' : 'Nữ' ?></li>
                        <li><h5>Địa chỉ </h5> <span>:</span><?= $model->address ?></li>
                    </ul>    	
                </div>                               
            </div><!-- personal-deatils -->	

            <div class="declaration section">
                <div class="icons">
                    <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                </div>   
                <div class="declaration-info">
                    <h3>Cam kết</h3>
                    <?= nl2br($model->declaration) ?> </div>                                 
            </div><!-- career-objective -->									
            <div class="buttons">
                <a href="#" class="btn">Send Email</a>
            </div>
            <div class="download-button">
                <a href="#" class="btn">Download Resume as doc</a>
            </div>
        </div><!-- resume-content -->						
    </div><!-- container -->
</section><!-- ad-profile-page -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn công việc cho ứng viên <?= $model->user->name ?></h4>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin(['id' => 'form_candidate']);
                ?>
                <?= $form->field($apply, 'resume_id')->hiddenInput(['value' => $model->id])->label(FALSE) ?>
                <?=
                        $form->field($apply, 'job_id')
                        ->checkboxList($apply->jobs(), [
                            'item' => function($index, $label, $name, $checked, $value)
                            {
                                $return = '<div class="checkbox"><label><input type="checkbox" name="' . $name . '" value="' . $label['id'] . '" >' . $label['title'] . '</label></div>';
                                return $return;
                            }
                        ])->label(FALSE);
                ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button id="btn_candidate" type="button" class="btn btn-primary">Đồng ý</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>
<?=
$this->registerJs('
    $(document).ready(function(){
    $("#btn_candidate").on("click", function(){
        $("#form_candidate").submit();
    });
});
        ');
?>
