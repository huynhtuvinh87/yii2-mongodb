<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Constant;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách việc làm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php
            $form = ActiveForm::begin(['id' => 'job']);
            ?>
            <?=
            DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    [
                        'label'  => 'Trạng thái',
                        'value'  => Html::dropDownList('Job[status]', $model->status, Constant::JOB_STATUS, ['class' => 'form-control', 'style' => 'width:150px']),
                        'format' => 'raw'
                    ],
                    'title', // title attribute (in plain text)
                    [
                        'label' => 'Mô tả',
                        'value' => nl2br($model->description),
                    ],
                    [
                        'label'  => 'Trách nhiệm',
                        'value'  => nl2br($model->responsibilities),
                        'format' => 'raw'
                    ],
                    [
                        'label'  => 'Yêu cầu',
                        'value'  => nl2br($model->request),
                        'format' => 'raw'
                    ],
                    [
                        'label'  => 'Danh mục',
                        'value'  => $model->category['title'],
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Ngôn ngữ lập trình',
                        'value' => function($model)
                        {
                            foreach ($model->program as $value)
                            {
                                $data[] = $value['title'];
                            }
                            return implode(',', $data);
                        },
                        'format'     => 'raw'
                    ],
                    [
                        'label'  => 'Địa điểm',
                        'value'  => $model->location['title'],
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Thông tin công ty',
                        'value' => function($model)
                        {
                            $info = $model->company;
                            $data = 'Tên: ' . $info['name'] . '<br>';
                            $data .= 'Email: ' . $info['email'] . '<br>';
                            $data .= 'Điện thoại: ' . $info['phone'] . '<br>';
                            $data .= 'Địa chỉ: ' . $info['address'] . '<br>';
                            $data .= 'Mã số thuế: ' . $info['tax_code'] . '<br>';
                            $data .= 'Website: ' . $info['website'] . '<br>';
                            $data .= 'Người đại diện: ' . $info['full_name'] . '<br>';
                            $data .= 'Quy mô công ty: ' . $info['company_size'] . '<br>';
                            return $data;
                        },
                        'format'                       => 'raw'
                    ],
                    [
                        'label'  => 'Hạn nộp hồ sơ',
                        'value'  => date('d/m/Y',$model->deadline),
                        'format' => 'raw'
                    ],
//                    [// the owner name of the model
//                        'label' => 'Owner',
//                        'value' => $model->owner->name,
//                    ],
                    'created_at:datetime', // creation date formatted as datetime
                    'updated_at:datetime',
                ],
            ]);
            ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?=
$this->registerJs('
    $(document).ready(function(){
        $("select").change(function (){
            $("#job").submit();
        });
});
        ');
?>
