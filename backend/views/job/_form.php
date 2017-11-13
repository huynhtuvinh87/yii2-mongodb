<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Enter title'])->label(FALSE) ?>
        <?= $form->field($model, 'description')->textarea(['style' => 'height:100px']) ?>
        <?= $form->field($model, 'content')->textarea(['class' => 'text-editor']) ?>

        <div class="x_title">
            Images
        </div>
        <div class="x_panel">
            <article>
                <?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'style' => 'display:none'])->label(FALSE) ?>
                <div id="result" class="row"/>
                <label for="postrealestateus-images" class="col-sm-3" style="border: 3px solid #ccc; text-align: center; height: 185px; padding-top: 10%">
                    Upload Images
                </label>
                <?php
                if ($model->images)
                {
                    foreach ($model->images as $key => $value)
                    {
                        ?>
                        <div class="col-sm-3 img-item">
                            <a href="javascript:void(0)">
                                <i class="fa fa-trash" style="position: absolute;top: 40%; left: 45%"></i>
                                <img src="<?= \Yii::$app->params['domain'] ?>/uploads/<?= $value ?>" style="width:100%; " class="img-thumbnail">
                                <input type="hidden" name="images[]" value="<?= $value ?>">
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </article>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="x_title">
            Status
        </div>
        <div class="x_panel">
            <?= $form->field($model, 'status')->dropDownList($model->publish)->label(FALSE) ?>
        </div>
        <div class="x_title">
            Price
        </div>
        <div class="x_panel">
            <?= $form->field($model, 'money')->dropDownList(['vnd' => 'VND', 'usd' => 'USD'])->label(FALSE) ?>
            <?= $form->field($model, 'price_min')->textInput(['placeholder' => 'Từ'])->label(FALSE) ?>
            <?= $form->field($model, 'price_max')->textInput(['placeholder' => 'Đến'])->label(FALSE) ?>
        </div>

        <div class="x_title">
            Categories
        </div>
        <div class="x_panel" style="max-height: 300px; overflow-y: scroll">
            <?=
                    $form->field($model, 'category')
                    ->checkboxList($model->cats(), [
                        'item' => function($index, $label, $name, $checked, $value)
                        {
                            $check = $label['checked'] == 1 ? ' checked="checked"' : '';
                            $return = '<div class="checkbox"><label><input type="checkbox" name="' . $name . '" ' . $check . ' value="' . $label['id'] . '" >' . $label['title'] . '</label></div>';
                            return $return;
                        }
                    ])->label(FALSE);
            ?>

        </div>

        <div class="form-group">
            <?= Html::submitButton(($model->isNewRecord) ? \Yii::t('app', 'Create') : \Yii::t('app', 'Update'), ['class' => ($model->isNewRecord) ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?=
$this->registerJs("
$(document).ready(function () {
        $(document).on('change', '.selector', function () {
            readURL(this, $(this).attr('data'));
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
     $(document).on('click', '.img-item a', function () { 
    $(this).parent().remove();
});
  $(document).on('click', '.img-item a', function () { 
    $(this).parent().remove();
});
document.getElementById('postrealestateus-images').addEventListener('change', handleFileSelect, false);
");
?>
