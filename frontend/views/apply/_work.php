<?php

use yii\bootstrap\Html;
?>
<div class="section">
    <h4>Lịch sử công việc <small><a href="javascript:void(0)" class="btn-work pull-right"><i class="fa fa-square"></i> Thêm mới</a></small></h4>
    <div class="work-edit" style="margin:0"> 
        <?php
        if (!empty($model->works))
        {
            foreach ($model->works as $k => $value)
            {
                ?>
                <div style=" overflow: hidden; margin-top: 20px">
                    <div class="row form-group">
                        <label class="col-sm-3 label-title">Tên công ty</label>
                        <div class="col-sm-9">
                            <input type="text" name="ApplyForm[work_company][]" class="form-control" value="<?= $value['work_company'] ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-3 label-title">Chức vụ</label>
                        <div class="col-sm-9">
                            <input type="text" name="ApplyForm[work_designation][]" class="form-control" value="<?= $value['work_designation'] ?>">
                        </div>
                    </div>
                    <div class="row form-group time-period">
                        <label class="col-sm-3 label-title">Thời gian làm việc</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?= Html::dropDownList('ApplyForm[work_time_begin][]', $value['work_time_begin'], $model->years, ['class' => 'form-control']) ?>
                                </div>
                                <div class="col-sm-1">đến</div>
                                <div class="col-sm-3">
                                    <?= Html::dropDownList('ApplyForm[work_time_end][]', $value['work_time_end'], $model->years, ['class' => 'form-control']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group job-description">
                        <label class="col-sm-3 label-title">Mô tả</label>
                        <div class="col-sm-9">
                            <textarea name="ApplyForm[work_description][]" class="form-control" rows="8"><?= $value['work_description'] ?></textarea>		
                        </div>
                    </div>
                    <div class="pull-right">
                        <a href="javascript:void(0)" class="btn btn-danger delete works-delete">Xóa</a>
                    </div>
                </div>
                <?php
            }
        } else
        {
            ?>
            <div style=" overflow: hidden; margin-top: 20px">
                <div class="row form-group">
                    <label class="col-sm-3 label-title">Tên công ty</label>
                    <div class="col-sm-9">
                        <input type="text" name="ApplyForm[work_company][]" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3 label-title">Chức vụ</label>
                    <div class="col-sm-9">
                        <input type="text" name="ApplyForm[work_designation][]" class="form-control">
                    </div>
                </div>
                <div class="row form-group time-period">
                    <label class="col-sm-3 label-title">Thời gian làm việc</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-3">
                                <?= Html::dropDownList('ApplyForm[work_time_begin][]', '', $model->years, ['class' => 'form-control']) ?>
                            </div>
                            <div class="col-sm-1">đến</div>
                            <div class="col-sm-3">
                                <?= Html::dropDownList('ApplyForm[work_time_end][]', '', $model->years, ['class' => 'form-control']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group job-description">
                    <label class="col-sm-3 label-title">Mô tả</label>
                    <div class="col-sm-9">
                        <textarea name="ApplyForm[work_description][]" class="form-control" rows="8"></textarea>		
                    </div>
                </div>
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-danger delete works-delete">Xóa</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="work-add" style="display:none;">
        <div style=" overflow: hidden; margin-top: 20px">
            <div class="row form-group">
                <label class="col-sm-3 label-title">Tên công ty</label>
                <div class="col-sm-9">
                    <input type="text" name="ApplyForm[work_company][]" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 label-title">Chức vụ</label>
                <div class="col-sm-9">
                    <input type="text" name="ApplyForm[work_designation][]" class="form-control">
                </div>
            </div>
            <div class="row form-group time-period">
                <label class="col-sm-3 label-title">Thời gian làm việc</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            <?= Html::dropDownList('ApplyForm[work_time_begin][]', '', $model->years, ['class' => 'form-control']) ?>
                        </div>
                        <div class="col-sm-1">đến</div>
                        <div class="col-sm-3">
                            <?= Html::dropDownList('ApplyForm[work_time_end][]', '', $model->years, ['class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group job-description">
                <label class="col-sm-3 label-title">Mô tả</label>
                <div class="col-sm-9">
                    <textarea name="ApplyForm[work_description][]" class="form-control" rows="8"></textarea>		
                </div>
            </div>
            <div class="pull-right">
                <a href="javascript:void(0)" class="btn btn-danger delete works-delete">Xóa</a>
            </div>
        </div>
    </div>

</div><!-- work-history -->
<?= $this->registerJs('
   $(document).on("click", ".btn-work", function (event){
        var data = $(".work-add").html();
        $(".work-edit").prepend(data);
    });
       $(document).on("click", ".works-delete", function (event){
        $(this).parent().parent().remove();
    });
') ?>