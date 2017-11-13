<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use common\widgets\Alert;

$this->title = 'Cập nhâp hồ sơ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .field-profile-birthday select, .field-profile-gender select{
        border: 1px solid #e3e3e3;
        margin-right: 20px;
        color: #a0a0a0;
        font-size: 16px;
        height: 43px;
        border-radius: 4px;
        padding: 6px 12px;
    }
</style>

<section class=" job-bg ad-details-page">
    <div class="container">
        <?= \frontend\widgets\MemberMenu::widget() ?>
        <div class="adpost-details post-resume">
            <div class="row">	
                <div class="col-md-12 clearfix">
                    <?php
                    $form = ActiveForm::begin([
                                'id'      => 'resumeform-form',
                                'options' => ['enctype' => 'multipart/form-data']
                    ]);
                    ?>
                    <?= Alert::widget() ?>
                    <fieldset>
                        <div class="section express-yourself">
                            <h4>Thông tin chung</h4>
                            <?=
                            $form->field($model, 'name', [
                                'options'  => ['class' => 'form-group row'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('name') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])
                            ?>
                            <?=
                            $form->field($model, 'information', [
                                'options'  => ['class' => 'form-group row additional-information'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('information') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])->textarea(['placeholder' => 'Địa chỉ: ' . $model->address . '\n Điện thoại: ' . $model->phone . ' \n Email: ' . $model->email . ''])
                            ?>
                            <div class="row form-group add-title location">
                                <label class="col-sm-3 label-title"><?= $model->getAttributeLabel('location') ?></label>
                                <div class="col-sm-4">
                                    <?= Html::dropDownList('ResumeForm[location]', $model->location, $model->location(), ['class' => 'form-control']) ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 label-title" for="resumeform-category"><?= $model->getAttributeLabel('category') ?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <?=
                                                $form->field($model, 'category')
                                                ->checkboxList($model->category(), [
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
                                <label class="col-sm-3 label-title" for="resumeform-program"><?= $model->getAttributeLabel('program') ?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <?=
                                                $form->field($model, 'program')
                                                ->checkboxList($model->program(), [
                                                    'item' => function($index, $label, $name, $checked, $value)
                                                    {
                                                        $check = $label['checked'] == 1 ? 'checked' : '';
                                                        $return = '<div class="col-sm-3"><div class="checkbox"><label class="' . $check . '"><input type="checkbox" name="' . $name . '" ' . $check . ' value="' . $label['id'] . '" >' . $label['title'] . '</label></div></div>';
                                                        return $return;
                                                    }
                                                ])->label(FALSE);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 label-title" for="resumeform-framework"><?= $model->getAttributeLabel('framework') ?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <?=
                                                $form->field($model, 'framework')
                                                ->checkboxList($model->framework(), [
                                                    'item' => function($index, $label, $name, $checked, $value)
                                                    {
                                                        $check = $label['checked'] == 1 ? ' checked' : '';
                                                        $return = '<div class="col-sm-3"><div class="checkbox"><label class="' . $check . '"><input type="checkbox" name="' . $name . '" ' . $check . ' value="' . $label['id'] . '" >' . $label['title'] . '</label></div></div>';
                                                        return $return;
                                                    }
                                                ])->label(FALSE);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- postdetails -->

                        <div class="section career-objective">
                            <?=
                            $form->field($model, 'career_objective', [
                                'options'  => ['class' => 'form-group row additional-information'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('career_objective') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])->textarea()
                            ?>
                        </div><!-- career-objective -->

                        <?= $this->render('_work', ['model' => $model]) ?>
                        <?= $this->render('_education', ['model' => $model]) ?>

                        <div class="section special-qualification">	
                            <?=
                            $form->field($model, 'qualification', [
                                'options'  => ['class' => 'form-group row additional-information'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('qualification') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])->textarea()
                            ?>
                        </div>							
                        <?= $this->render('_language', ['model' => $model]) ?>
                        <div class="section company-information">
                            <h4>Thông tin chi tiết</h4>
                            <?=
                            $form->field($model, 'father_name', [
                                'options'  => ['class' => 'form-group row'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('father_name') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])
                            ?>
                            <?=
                            $form->field($model, 'mother_name', [
                                'options'  => ['class' => 'form-group row'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('mother_name') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])
                            ?>
                            <div class="row form-group field-resumeform-birthday">
                                <label class="col-sm-3 label-title" for="resumeform-birthday"><?= $model->getAttributeLabel('birthday') ?></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <?= Html::dropDownList('ResumeForm[day]', $model->day, $model->days, ['class' => 'form-control']) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= Html::dropDownList('ResumeForm[month]', $model->month, $model->months, ['class' => 'form-control']) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= Html::dropDownList('ResumeForm[year]', $model->year, $model->years, ['class' => 'form-control']) ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?=
                            $form->field($model, 'birth_place', [
                                'options'  => ['class' => 'form-group row'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('birth_place') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])
                            ?>
                            <?=
                            $form->field($model, 'nationality', [
                                'options'  => ['class' => 'form-group row'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('nationality') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])
                            ?>
                            <div class="row form-group">
                                <label class="col-sm-3 label-title"><?= $model->getAttributeLabel('gender') ?></label>
                                <div class="col-sm-9">
                                    <?= Html::dropDownList('ResumeForm[gender]', $model->gender, [1 => 'Nam', 2 => 'Nữ'], ['class' => 'form-control']) ?>
                                </div>
                            </div>
                            <?=
                            $form->field($model, 'address', [
                                'options'  => ['class' => 'form-group row'],
                                "template" => "<label class=\"col-sm-3 label-title\">" . $model->getAttributeLabel('address') . "</label><div class='col-sm-9'>\n{input}\n{hint}\n{error}</div>"
                            ])
                            ?>

                        </div><!-- section -->
                        <div class="section special-qualification">
                            <div class="row form-group">
                                <label class="col-sm-3 label-title">Mức lương mong muốn</label>
                                <div class="col-sm-3">
                                    <?= Html::dropDownList('ResumeForm[expected_salary]', $model->expected_salary, $model->salaryLevel, ['class' => 'form-control']) ?>
                                </div>
                            </div>
                        </div>	
                        <div class="section special-qualification">
                            <div class="row form-group">
                                <label class="col-sm-3 label-title">Cam kết</label>
                                <div class="col-sm-9">
                                    <?= Html::textarea('ResumeForm[declaration]', $model->declaration, ['class' => 'form-control']) ?>
                                </div>	
                            </div>
                            <div class="buttons">
                                <button class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div><!-- special-qualification -->	

                    </fieldset>


                    <?php ActiveForm::end(); ?>
                </div>

            </div><!-- photos-ad -->				
        </div>	
    </div><!-- container -->
</section><!-- main -->

<?=
$this->registerJs("
$(document).ready(function () {
        $(document).on('change', '#photo', function () {
            readURL(this, '#rs-photo');
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
