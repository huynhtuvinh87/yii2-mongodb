<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use common\widgets\Alert;

$this->title = 'Cập nhât công việc';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class=" job-bg ad-details-page">
    <div class="container">
        <?= \frontend\widgets\MemberMenu::widget() ?>
        <div class="job-postdetails">
            <div class="row">	
                <div class="col-md-12">
                    <?= $this->render('_form', ['model' => $model]) ?>	
                </div>

            </div><!-- photos-ad -->				
        </div>	
    </div><!-- container -->
</section><!-- main -->
