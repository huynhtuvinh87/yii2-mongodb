<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Constant;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Người tìm việc', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    th{
        width: 200px
    }
    td label{
        width: 150px;
    }
</style>
<div class="page-index">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php
            $form = ActiveForm::begin(['id' => 'member']);
            ?>
            <?=
            DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    [
                        'label'  => 'Trạng thái',
                        'value'  => Html::dropDownList('Account[status]', $model->status, Constant::ACCOUNT_STATUS, ['class' => 'form-control', 'style' => 'width:150px']),
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Họ và tên',
                        'value' => nl2br($model->name)
                    ],
                    [
                        'label' => 'Ngày sinh',
                        'value' => $model->resume->birthday
                    ],
                    [
                        'label' => 'Địa điểm',
                        'value' => $model->resume->location['title']
                    ],
                    [
                        'label'  => 'Thông tin',
                        'format' => 'raw',
                        'value'  => nl2br($model->resume->information)
                    ],
                    [
                        'label'  => 'Trình độ chuyên môn',
                        'format' => 'raw',
                        'value'  => nl2br($model->resume->qualification)
                    ],
                    [
                        'label'  => 'Lịch sử công việc',
                        'format' => 'raw',
                        'value'  => function ($model)
                        {
                            $data = '';
                            if ($model->resume->works)
                            {
                                foreach ($model->resume->works as $key => $value)
                                {

                                    $data .= '<label>Công ty</label>: ' . $value['work_company'] . '<br>';
                                    $data .= '<label>Chức vụ</label>: ' . $value['work_designation'] . '<br>';
                                    $data .= '<label>Thời gian làm việc</label>: ' . $value['work_time_begin'] . ' đến ' . $value['work_time_end'] . '<br><br>';
                                }
                            }
                            return $data;
                        }
                    ],
                    [
                        'label'  => 'Trình độ',
                        'format' => 'raw',
                        'value'  => function ($model)
                        {
                            $data = '';
                            if ($model->resume->education)
                            {
                                foreach ($model->resume->education as $key => $value)
                                {

                                    $data .= '<label>Trường</label>: ' . $value['education_institute_name'] . '<br>';
                                    $data .= '<label>Trình độ</label>: ' . $value['education_degree'] . '<br>';
                                    $data .= '<label>Thời gian học</label>: ' . $value['education_time_begin'] . ' đến ' . $value['education_time_end'] . '<br><br>';
                                }
                            }
                            return $data;
                        }
                    ],
                    [
                        'label'  => 'Ngoại ngữ',
                        'format' => 'raw',
                        'value'  => function ($model)
                        {
                            $data = '';
                            if ($model->resume->language)
                            {
                                foreach ($model->resume->language as $key => $value)
                                {

                                    $data .= $value['language_name'] . ' (Cấp độ: ' . $value['language_level'] . ')<br>';
                                }
                            }
                            return $data;
                        }
                    ],
                    [
                        'label'  => 'Chuyên ngành',
                        'format' => 'raw',
                        'value'  => function ($model)
                        {
                            $data = '';
                            if ($model->resume->category)
                            {
                                foreach ($model->resume->category as $key => $value)
                                {

                                    $data .= $value['title'] . '<br>';
                                }
                            }
                            return $data;
                        }
                    ],
                    [
                        'label'  => 'Ngôn ngữ lập trình',
                        'format' => 'raw',
                        'value'  => function ($model)
                        {
                            $data = [];
                            if ($model->resume->program)
                            {
                                foreach ($model->resume->program as $key => $value)
                                {
                                    $data[] = $value['title'];
                                }
                            }
                            return implode(', ', $data);
                        }
                    ],
                    [
                        'label'  => 'Framework',
                        'format' => 'raw',
                        'value'  => function ($model)
                        {
                            $data = [];
                            if ($model->resume->framework)
                            {
                                foreach ($model->resume->framework as $key => $value)
                                {
                                    $data[] = $value['title'];
                                }
                            }
                            return implode(', ', $data);
                        }
                    ],
                    [
                        'label'  => 'Cam kết',
                        'format' => 'raw',
                        'value'  => nl2br($model->resume->declaration)
                    ],
//                    [
//                        'label'  => 'Trách nhiệm',
//                        'value'  => nl2br($model->responsibilities),
//                        'format' => 'raw'
//                    ],
//                    [
//                        'label'  => 'Yêu cầu',
//                        'value'  => nl2br($model->request),
//                        'format' => 'raw'
//                    ],
//                    [
//                        'label'  => 'Danh mục',
//                        'value'  => $model->category['title'],
//                        'format' => 'raw'
//                    ],
//                    [
//                        'label' => 'Ngôn ngữ lập trình',
//                        'value' => function($model)
//                        {
//                            foreach ($model->programming as $value)
//                            {
//                                $data[] = $value['title'];
//                            }
//                            return implode(',', $data);
//                        },
//                        'format'     => 'raw'
//                    ],
//                    [
//                        'label'  => 'Địa điểm',
//                        'value'  => $model->location['title'],
//                        'format' => 'raw'
//                    ],
//                    [
//                        'label' => 'Thông tin công ty',
//                        'value' => function($model)
//                        {
//                            $info = $model->company;
//                            $data = 'Tên: ' . $info['name'] . '<br>';
//                            $data .= 'Email: ' . $info['email'] . '<br>';
//                            $data .= 'Điện thoại: ' . $info['phone'] . '<br>';
//                            $data .= 'Địa chỉ: ' . $info['address'] . '<br>';
//                            $data .= 'Mã số thuế: ' . $info['tax_code'] . '<br>';
//                            $data .= 'Website: ' . $info['website'] . '<br>';
//                            $data .= 'Người đại diện: ' . $info['full_name'] . '<br>';
//                            $data .= 'Quy mô công ty: ' . $info['company_size'] . '<br>';
//                            return $data;
//                        },
//                        'format'                       => 'raw'
//                    ],
//                    [
//                        'label'  => 'Hạn nộp hồ sơ',
//                        'value'  => $model->deadline['day'] . '/' . $model->deadline['month'] . '/' . $model->deadline['year'],
//                        'format' => 'raw'
//                    ],
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
            $("#member").submit();
        });
});
        ');
?>
