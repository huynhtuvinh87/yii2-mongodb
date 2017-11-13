<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use common\widgets\Alert;
?>
<style>
    .item-description textarea{
        min-height: 200px
    }
</style>
<?php
$form = ActiveForm::begin([
            'id'      => 'resumeform-form',
            'options' => ['enctype' => 'multipart/form-data']
        ]);
?>
<?= Alert::widget() ?>
<fieldset>
    <div class="section company-information">
        <h4><?= $this->title ?></h4>
        <?=
        $form->field($model, 'name', [
            'options'  => ['class' => 'form-group row'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('name') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <div class="row form-group">
            <label class="col-sm-3 label-title" for="jobform-photo"><?= $model->getAttributeLabel('logo') ?></label>
            <div class="col-sm-9">
                <label for="logo">
                    <?= Html::fileInput('Company[logo]', '', ['style' => 'display:none', 'id' => 'logo']) ?>
                    <img src="<?= $model->logo() ?>" style="max-width:150px" class="img-thumbnail" id="rs-logo">
                    Type: JPG, PNG
                </label>
            </div>
        </div>
        <?=
        $form->field($model, 'company_size', [
            'options'  => ['class' => 'form-group row'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('company_size') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <?=
        $form->field($model, 'tax_code', [
            'options'  => ['class' => 'form-group row'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('tax_code') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <?=
        $form->field($model, 'email', [
            'options'  => ['class' => 'form-group row'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('email') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <?=
        $form->field($model, 'phone', [
            'options'  => ['class' => 'form-group row'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('phone') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <?=
        $form->field($model, 'address', [
            'options'  => ['class' => 'form-group row'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('address') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <?=
        $form->field($model, 'website', [
            'options'  => ['class' => 'form-group row'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('website') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <?=
        $form->field($model, 'about', [
            'options'  => ['class' => 'form-group row item-description'],
            "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('about') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
        ])->textarea()
        ?>
        <div class="form-group row">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div><!-- section -->


</fieldset>
<?php ActiveForm::end(); ?>

<?=
$this->registerJs("
$(document).ready(function () {
        $(document).on('change', '#logo', function () {
        readURL(this, '#rs-logo');
        });
        function readURL(input, id_show) {
        if(input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        $(id_show).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }
        }
        });
");
?>

