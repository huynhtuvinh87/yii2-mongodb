<?php

use yii\bootstrap\Html;
?>
<div class="section education-background">
    <h4>Học vấn <small><a href="javascript:void(0)" class="btn-education pull-right"><i class="fa fa-square"></i> Thêm mới</a></small></h4>
    <div class="education-edit" style="margin:0"> 
        <?php
        if (!empty($model->education))
        {
            foreach ($model->education as $k => $value)
            {
                ?>
                <div style=" overflow: hidden; margin-top: 20px">
                    <div class="row form-group">
                        <label class="col-sm-3 label-title">Tên trường</label>
                        <div class="col-sm-9">
                            <input type="text" name="ApplyForm[education_institute_name][]" class="form-control" value="<?= $value['education_institute_name'] ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-3 label-title">Trình độ</label>
                        <div class="col-sm-9">
                            <input type="text" name="ApplyForm[education_degree][]" class="form-control" value="<?= $value['education_institute_name'] ?>">
                        </div>
                    </div>
                    <div class="row form-group time-period">
                        <label class="col-sm-3 label-title">Thời gian học</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?= Html::dropDownList('ApplyForm[education_time_begin][]', $value['education_time_begin'], $model->years, ['class' => 'form-control']) ?>
                                </div>
                                <div class="col-sm-1">đến</div>
                                <div class="col-sm-3">
                                    <?= Html::dropDownList('ApplyForm[education_time_end][]', $value['education_time_end'], $model->years, ['class' => 'form-control']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group job-description">
                        <label class="col-sm-3 label-title">Mô tả</label>
                        <div class="col-sm-9">
                            <textarea name="ApplyForm[education_description][]" class="form-control" rows="8"><?= $value['education_description'] ?></textarea>		
                        </div>
                    </div>
                    <div class="pull-right">
                        <a href="javascript:void(0)" class="btn btn-danger education-delete">Xóa</a>
                    </div>
                </div>
                <?php
            }
        } else
        {
            ?>
            <div style=" overflow: hidden; margin-top: 20px">
                <div class="row form-group">
                    <label class="col-sm-3 label-title">Tên trường</label>
                    <div class="col-sm-9">
                        <input type="text" name="ApplyForm[education_institute_name][]" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3 label-title">Trình độ</label>
                    <div class="col-sm-9">
                        <input type="text" name="ApplyForm[education_degree][]" class="form-control">
                    </div>
                </div>
                <div class="row form-group time-period">
                    <label class="col-sm-3 label-title">Thời gian học</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-3">
                                <?= Html::dropDownList('ApplyForm[education_time_begin][]', '', $model->years, ['class' => 'form-control']) ?>
                            </div>
                            <div class="col-sm-1">đến</div>
                            <div class="col-sm-3">
                                <?= Html::dropDownList('ApplyForm[education_time_end][]', '', $model->years, ['class' => 'form-control']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group job-description">
                    <label class="col-sm-3 label-title">Mô tả</label>
                    <div class="col-sm-9">
                        <textarea name="ApplyForm[education_description][]" class="form-control" rows="8"></textarea>		
                    </div>
                </div>
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-danger education-delete">Xóa</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="education-add" style="display:none;">
        <div style=" overflow: hidden; margin-top: 20px">
            <div class="row form-group">
                <label class="col-sm-3 label-title">Tên trường học</label>
                <div class="col-sm-9">
                    <input type="text" name="ApplyForm[education_institute_name][]" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 label-title">Trình độ</label>
                <div class="col-sm-9">
                    <input type="text" name="ApplyForm[education_degree][]" class="form-control">
                </div>
            </div>
            <div class="row form-group time-period">
                <label class="col-sm-3 label-title">Thời gian học</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            <?= Html::dropDownList('ApplyForm[education_time_begin][]', '', $model->years, ['class' => 'form-control']) ?>
                        </div>
                        <div class="col-sm-1">đến</div>
                        <div class="col-sm-3">
                            <?= Html::dropDownList('ApplyForm[education_time_end][]', '', $model->years, ['class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group job-description">
                <label class="col-sm-3 label-title">Mô tả</label>
                <div class="col-sm-9">
                    <textarea name="ApplyForm[education_description][]" class="form-control" rows="8"></textarea>		
                </div>
            </div>
            <div class="pull-right">
                <a href="javascript:void(0)" class="btn btn-danger education-delete">Xóa</a>
            </div>
        </div>
    </div>

</div><!-- work-history -->
<?= $this->registerJs('
   $(document).on("click", ".btn-education", function (event){
        var data = $(".education-add").html();
        $(".education-edit").prepend(data);
    });
       $(document).on("click", ".education-delete", function (event){
        $(this).parent().parent().remove();
    });
') ?>