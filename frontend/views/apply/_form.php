<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use common\widgets\Alert;

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
            "template" => "<label class=\"col-sm-4 label-title\">" . $model->getAttributeLabel('name') . "</label><div class='col-sm-8'>\n{input}\n{hint}\n{error}</div>"
        ])
        ?>
        <?=
        $form->field($model, 'information', [
            'options'  => ['class' => 'form-group row additional-information'],
            "template" => "<label class=\"col-sm-4 label-title\">" . $model->getAttributeLabel('information') . "</label><div class='col-sm-8'>\n{input}\n{hint}\n{error}</div>"
        ])->textarea(['placeholder' => 'Address: ' . $model->address . '\n Phone: ' . $model->phone . ' \n Email: ' . $model->email . ''])
        ?>

        <div class="row form-group photos-resumeform">
            <label class="col-sm-4 label-title" for="resumeform-photo"><?= $model->getAttributeLabel('photo') ?></label>
            <div class="col-sm-8 ">
                <label for="photo">
                    <?= Html::fileInput('ApplyForm[photo]', '', ['style' => 'display:none', 'id' => 'photo']) ?>
                    <img src="<?= $model->photo() ?>" class="img-thumbnail" id="rs-photo">
                    Type: JPG, PNG
                </label>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-4 label-title" for="resumeform-category"><?= $model->getAttributeLabel('category') ?></label>
            <div class="col-sm-8">
                <div class="row">
                    <?=
                            $form->field($model, 'category')
                            ->checkboxList($model->categories, [
                                'item' => function($index, $label, $name, $checked, $value)
                                {
                                    $check = $label['checked'] == 1 ? 'checked' : '';
                                    $return = '<div class="col-sm-6"><div class="checkbox"><label class="' . $check . '"><input type="checkbox" name="' . $name . '" ' . $check . ' value="' . $label['id'] . '" >' . $label['title'] . '</label></div></div>';
                                    return $return;
                                }
                            ])->label(FALSE);
                    ?>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-4 label-title" for="resumeform-programming"><?= $model->getAttributeLabel('programming') ?></label>
            <div class="col-sm-8">
                <div class="row">
                    <?=
                            $form->field($model, 'programming')
                            ->checkboxList($model->programmings, [
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
            <label class="col-sm-4 label-title" for="resumeform-framework"><?= $model->getAttributeLabel('framework') ?></label>
            <div class="col-sm-8">
                <div class="row">
                    <?=
                            $form->field($model, 'framework')
                            ->checkboxList($model->frameworks, [
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
    </div><!-- postdetails -->

    <div class="section career-objective">
        <h4><?= $model->getAttributeLabel('career_objective') ?></h4>
        <?=
        $form->field($model, 'career_objective')->textarea()->label(FALSE)
        ?>
    </div><!-- career-objective -->

    <?= $this->render('_work', ['model' => $model]) ?>
    <?= $this->render('_education', ['model' => $model]) ?>

    <div class="section special-qualification">
        <h4>Trình độ chuyên môn</h4>
        <div class="form-group item-description">
            <?= Html::textarea('ApplyForm[qualification]', $model->qualification, ['class' => 'form-control']) ?>
        </div>								
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
                        <?= Html::dropDownList('ApplyForm[day]', $model->day, $model->days, ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= Html::dropDownList('ApplyForm[month]', $model->month, $model->months, ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= Html::dropDownList('ApplyForm[year]', $model->year, $model->years, ['class' => 'form-control']) ?>
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
                <?= Html::dropDownList('ApplyForm[gender]', $model->gender, [1 => 'Nam', 2 => 'Nữ'], ['class' => 'form-control']) ?>
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
        <h4>Mức lương mong muốn</h4>
        <div class="form-group item-description">
            <?= Html::dropDownList('ApplyForm[expected_salary]', $model->expected_salary, $model->salaryLevel, ['class' => 'form-control']) ?>
        </div>								
    </div>	
    <div class="section special-qualification">
        <h4>Cam kết</h4>
        <div class="form-group item-description">
            <?= Html::textarea('ApplyForm[declaration]', $model->declaration, ['class' => 'form-control']) ?>
        </div>	
        <div class="buttons">
            <button class="btn btn-primary">Apply</button>
        </div>
    </div><!-- special-qualification -->	

</fieldset>


<?php ActiveForm::end(); ?>