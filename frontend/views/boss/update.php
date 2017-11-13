<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Cập nhật tài khoản';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .field-profilemember-birthday select, .field-profilemember-gender select{
        border: 1px solid #e3e3e3;
        margin-right: 20px;
        color: #a0a0a0;
        font-size: 16px;
        height: 43px;
        border-radius: 4px;
        padding: 6px 12px;
    }
</style>
<section class="clearfix job-bg  ad-profile-page">
    <div class="container">
        <?= \frontend\widgets\BossMenu::widget() ?>
        <?= \common\widgets\Alert::widget() ?>
        <div class="profile job-profile">
            <div class="user-pro-section">
                <?php $form = ActiveForm::begin(['id' => 'profile-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <!-- profile-details -->
                <div class="profile-details section">
                    <h2>Cập nhật thông tin cá nhân</h2>
                    <div class="row form-group field-profileboss-avatar">
                        <label class="col-sm-3 label-title" for="profilemember-avatar"><?= $profile->getAttributeLabel('avatar') ?></label>
                        <div class="col-sm-9">
                            <label for="avatar">
                                <?= Html::fileInput('ProfileBoss[avatar]', '', ['style' => 'display:none', 'id' => 'avatar']) ?>
                                <img src="<?= $profile->avatar() ?>" class="img-thumbnail" id="rs-avatar" style="max-width:200px">
                            </label>
                        </div>
                    </div>
            
                    <?=
                    $form->field($profile, 'name', [
                        'options'  => ['class' => 'form-group row'],
                        "template" => "<label class=\"col-sm-3 label-title\">" . $profile->getAttributeLabel('name') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                    ])
                    ?>
                    <?=
                    $form->field($profile, 'email', [
                        'options'  => ['class' => 'form-group row'],
                        "template" => "<label class=\"col-sm-3 label-title\">" . $profile->getAttributeLabel('email') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                    ])
                    ?>
            
                    <?=
                    $form->field($profile, 'phone', [
                        'options'  => ['class' => 'form-group row'],
                        "template" => "<label class=\"col-sm-3 label-title\">" . $profile->getAttributeLabel('phone') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                    ])
                    ?>
                    <div class="row form-group">
                        <label class="col-sm-3 label-title"><?= $profile->getAttributeLabel('city') ?></label>
                        <div class="col-sm-9">
                            <?= Html::dropDownList('ProfileBoss[city]', $profile->city, $profile->cities, ['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <?=
                    $form->field($profile, 'address', [
                        'options'  => ['class' => 'form-group row'],
                        "template" => "<label class=\"col-sm-3 label-title\">" . $profile->getAttributeLabel('address') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                    ])
                    ?>
                    <div class="row form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button  class="btn btn-success">Cập nhật</button>
                        </div>												
                    </div><!-- preferences-settings -->
                </div><!-- profile-details -->

                <?php ActiveForm::end(); ?>	
            </div><!-- user-pro-edit -->
        </div>				
    </div><!-- container -->
</section><!-- ad-profile-page -->
<?=
$this->registerJs("
$(document).ready(function () {
        $(document).on('change', '#avatar', function () {
            readURL(this, '#rs-avatar');
        });
        function readURL(input, id_show) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(id_show).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
");
?>