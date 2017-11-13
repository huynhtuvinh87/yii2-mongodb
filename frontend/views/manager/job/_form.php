<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use common\widgets\Alert;
use common\components\Constant;
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
    <div class="row">
        <div class="col-sm-8">
            <div class="section postdetails" style="border:1px solid #e3e3e3;">
                <h4>Thông tin công việc</h4>
                <div class="row form-group add-title">
                    <label class="col-sm-3 label-title"><?= $model->getAttributeLabel('category') ?></label>
                    <div class="col-sm-9">
                        <?= Html::dropDownList('JobForm[category]', $model->category, Constant::category(), ['class' => 'form-control']) ?>
                    </div>
                </div>		
                <div class="row form-group">
                    <label class="col-sm-3 label-title"><?= $model->getAttributeLabel('programming') ?></label>
                    <div class="col-sm-9">
                        <div class="row">
                            <?=
                                    $form->field($model, 'program')
                                    ->checkboxList(Constant::program($model->program), [
                                        'item' => function($index, $label, $name, $checked, $value)
                                        {
                                            $check = $label['checked'] == 1 ? 'checked' : '';
                                            $return = '<div class="col-sm-4"><div class="checkbox"><label class="' . $check . '"><input type="checkbox" name="' . $name . '" ' . $check . ' value="' . $label['id'] . '" >' . $label['title'] . '</label></div></div>';
                                            return $return;
                                        }
                                    ])->label(FALSE);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3 label-title"><?= $model->getAttributeLabel('framework') ?></label>
                    <div class="col-sm-9">
                        <div class="row">
                            <?=
                                    $form->field($model, 'framework')
                                    ->checkboxList(Constant::framework($model->framework), [
                                        'item' => function($index, $label, $name, $checked, $value)
                                        {
                                            $check = $label['checked'] == 1 ? ' checked' : '';
                                            $return = '<div class="col-sm-4"><div class="checkbox"><label class="' . $check . '"><input type="checkbox" name="' . $name . '" ' . $check . ' value="' . $label['id'] . '" >' . $label['title'] . '</label></div></div>';
                                            return $return;
                                        }
                                    ])->label(FALSE);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3">Hình thức làm việc</label>
                    <div class="col-sm-9 user-type">
                        <?php
                        $name = "JobForm[sell_type]";
                        echo Html::radioList($name, $model->sell_type, Constant ::JOB_TYPE, [
                            'item' => function ($index, $label, $name, $checked, $value)
                            {
                                $check = !empty($checked) ? "checked" : "";
                                return '<input type="radio" name="' . $name . '" ' . $check . ' value="' . $value . '" id="' . $value . '"> <label for="' . $value . '">' . $label . '</label>';
                            },
                        ]);
                        ?>	
                    </div>
                </div>
                <?=
                $form->field($model, 'title', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('title') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>				
                <?=
                $form->field($model, 'description', [
                    'options'  => ['class' => 'form-group row item-description'],
                    "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('description') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                ])->textarea()
                ?>
                <div class="row characters">
                    <div class="col-sm-9 col-sm-offset-3">
                        <p>5000 characters left</p>
                    </div>
                </div>	
                <?=
                $form->field($model, 'request', [
                    'options'  => ['class' => 'form-group row item-description'],
                    "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('request') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                ])->textarea()
                ?>
                <div class="row characters">
                    <div class="col-sm-9 col-sm-offset-3">
                        <p>5000 characters left</p>
                    </div>
                </div>	
                <?=
                $form->field($model, 'responsibilities', [
                    'options'  => ['class' => 'form-group row item-description'],
                    "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('responsibilities') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                ])->textarea()
                ?>
                <div class="row characters">
                    <div class="col-sm-9 col-sm-offset-3">
                        <p>5000 characters left</p>
                    </div>
                </div>	
                <div class="row form-group add-title location">
                    <label class="col-sm-3 label-title"><?= $model->getAttributeLabel('location') ?></label>
                    <div class="col-sm-3">
                        <?= Html::dropDownList('JobForm[location]', $model->location, Constant::location(), ['class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="row form-group select-price">
                    <label class="col-sm-3 label-title">Mức lương</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-8 price">
                                <?= Html::textInput('JobForm[price_min]', $model->price_min, ['id' => 'jobform-price_min', 'class' => 'form-control', 'placeholder' => 'Mức lương thấp nhất', 'disabled' => $model->price_negotiable == 1 ? TRUE : FALSE]) ?>
                                <span>-</span>
                                <?= Html::textInput('JobForm[price_max]', $model->price_max, ['id' => 'jobform-price_max', 'class' => 'form-control', 'placeholder' => 'Mức lương cao nhất', 'disabled' => $model->price_negotiable == 1 ? TRUE : FALSE]) ?>
                            </div>
                            <div class="col-sm-4">
                                <div class="checkbox">

                                    <label for="jobform-negotiable" class="<?= $model->price_negotiable == 1 ? "checked" : "" ?>">
                                        <?= Html::checkbox('JobForm[price_negotiable]', $model->price_negotiable, ['class' => 'form-control', 'id' => 'jobform-negotiable', 'value' => 1, 'checked' => $model->price_negotiable == 1 ? TRUE : FALSE]) ?>
                                        Thương lượng 
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
                      <?=
                $form->field($model, 'deadline', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('deadline') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
            </div><!-- postdetails -->

        </div>
        <div class="col-sm-4">
            <div class="section company-companyrmation" style="border:1px solid #e3e3e3;">
                <h4>Thông tin liên hệ</h4>
                <?=
                $form->field($model, 'company_name', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_name')
                    . "</label><div class='col-sm-12'>"
                    . Html::dropDownList('JobForm[company_id]', $model->company_id, Constant::company(), ['class' => 'form-control', 'id' => 'select_company'])
                    . "</div><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])->hiddenInput()
                ?>
                <div class="row form-group">
                    <label class="col-sm-12 label-title" for="jobform-photo"><?= $model->getAttributeLabel('logo') ?></label>
                    <div class="col-sm-12">
                        <label for="logo">
                            <?= Html::fileInput('JobForm[company_logo]', '', ['style' => 'display:none', 'id' => 'logo']) ?>
                            <img src="<?= $model->company_logo ?>" style="max-width:150px" class="img-thumbnail" id="rs-logo">
                            Type: JPG, PNG
                        </label>
                    </div>
                </div>
                <?=
                $form->field($model, 'company_size', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_size') . "</label><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
                <?=
                $form->field($model, 'company_tax_code', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_tax_code') . "</label><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
                <?=
                $form->field($model, 'company_email', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_email') . "</label><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
                <?=
                $form->field($model, 'company_phone', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_phone') . "</label><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
                <?=
                $form->field($model, 'company_address', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_address') . "</label><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
                <?=
                $form->field($model, 'company_website', [
                    'options'  => ['class' => 'form-group row'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_website') . "</label><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])
                ?>
                <?=
                $form->field($model, 'company_about', [
                    'options'  => ['class' => 'form-group row item-description'],
                    "template" => "<label class=\"col-sm-12 label-title\">" . $model->getAttributeLabel('company_about') . "</label><div class='col-sm-12'>\n{input}\n{hint}\n{error}</div>"
                ])->textarea()
                ?>
                <div class="form-group row">
                    <div class='col-sm-12'>
                        <button type="submit" class="btn btn-primary">Lưu công việc</button>
                    </div>
                </div><!-- section -->

            </div><!-- section -->

        </div>
    </div>



</fieldset>
<?php ActiveForm::end(); ?>

<?= $this->registerJs('
    $(document).ready(function () {
        $("#jobform-negotiable").change(function () {
            if ($(this).is(":checked")) {
                $("#jobform-price_min").prop("disabled", true);
                $("#jobform-price_max").prop("disabled", true);
                $("#jobform-price_min").val("");
                $("#jobform-price_max").val("");
            } else {
                $("#jobform-price_min").prop("disabled", false);
                $("#jobform-price_max").prop("disabled", false);
            }
        });
       
    })

    $("#jobform-deadline").datetimepicker({
        pickTime:false,
        formatDate:"Y/m/d",
        minDate: new Date(),
    });
') ?>

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

<?= $this->registerJs('
    $("#select_company").on("change",function(){    
        $.ajax({
            url:"' . Yii::$app->urlManager->createAbsoluteUrl(["ajax/company"]) . '",
            type:"POST",            
            data:"id="+$("#select_company option:selected").val(),
            dataType:"json",
            success:function(rs){     
                var result = rs.data;
                if(result){
                    $("#jobform-company_name").val(result.name);
                    $("#jobform-company_email").val(result.email);
                    $("#jobform-company_tax_code").val(result.tax_code);
                    $("#jobform-company_phone").val(result.phone);
                    $("#jobform-company_address").val(result.address);
                    $("#jobform-company_website").val(result.website);
                    $("#jobform-company_about").val(result.about);
                    $("#jobform-company_size").val(result.company_size);
                    $("#rs-logo").attr("src",result.logo);
                }else{
                    $("#jobform-company_name, #jobform-company_size, #jobform-company_email,#jobform-company_phone,#jobform-company_address,#jobform-company_website,#jobform-company_about,#jobform-company_tax_code").val("");
                }
            }
        });
    });
') ?>
<?= $this->registerJs('
    $("#jobform-deadline_year, #jobform-deadline_month").on("change",function(){    
        var year = $("#jobform-deadline_year option:selected").val();
        var month = $("#jobform-deadline_month option:selected").val();
        if(year && month){
            $("#jobform-deadline").val(month);
            $.ajax({
                url:"' . Yii::$app->urlManager->createAbsoluteUrl(["ajax/day"]) . '",
                type:"POST",            
                data:{"year":year,"month":month},
                success:function(rs){     
                    if(rs){
                        var html = "";
                        for (index = 0; index < rs.data.length; ++index) {
                            html += "<option value="+rs.data[index]+">"+rs.data[index]+"</option>";
                        }   
                        $("#jobform-deadline_day").html(html);
                    }
                }
            });
        }
    });
') ?>

