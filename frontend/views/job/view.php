<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Hồ sơ cá nhân';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class=" job-bg page  ad-profile-page">
    <div class="container">
        <?= $this->render('/member/_menu', ['model' => $user]) ?>
        <div class="resume-content">
            <div class="profile section clearfix">
                <div class="profile-logo">
                    <img class="img-responsive" src="<?= $user->avatar() ?>" alt="Image" style="max-width: 150px">
                </div>
                <div class="profile-info">
                    <h1><?= $user->name ?></h1>
                    <address>
                        <p>Address: <?= $user->address ?> <br> Phone: <?= $user->phone ?> <br> Email:<a href="#"> <?= $user->email ?></a></p>
                    </address>
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
                    <?= !empty($model->programming) ?  implode(', ', $model->programming) : "" ?><br>
                    <?= !empty($model->framework) ?  implode(', ', $model->framework) : "" ?><p>
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
                    <h3>Lời khai</h3>
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
