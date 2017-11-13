
<div class="section language-proficiency">
    <h4>Trình độ ngoại ngữ <small><a href="javascript:void(0)" class="btn-language pull-right"><i class="fa fa-square"></i> Thêm mới</a></small></h4>
    <div class="language-edit" style="margin:0"> 
        <?php
        if (!empty($model->language))
        {
            foreach ($model->language as $k => $value)
            {
                ?>
                <div style=" overflow: hidden; margin-top: 20px">
                    <div class="row form-group">
                        <label class="col-sm-3 label-title">Tên</label>
                        <div class="col-sm-9">
                            <input type="text" name="ApplyForm[language_name][]" class="form-control" value="<?= $value['language_name'] ?>">
                        </div>
                    </div>
                    <div class="row form-group rating">
                        <label class="col-sm-3 label-title">Cấp độ</label>
                        <div class="col-sm-9">
                            <input type="text" name="ApplyForm[language_level][]" class="form-control" value="<?= $value['language_level'] ?>">
                        </div>
                    </div>
                    <div class="pull-right">
                        <a href="javascript:void(0)" class="btn btn-danger language-delete">Xóa</a>
                    </div>
                </div>
                <?php
            }
        } else
        {
            ?>
            <div style=" overflow: hidden; margin-top: 20px">
                <div class="row form-group">
                    <label class="col-sm-3 label-title">Tên</label>
                    <div class="col-sm-9">
                        <input type="text" name="ApplyForm[language_name][]" class="form-control" placeholder="English">
                    </div>
                </div>
                <div class="row form-group rating">
                    <label class="col-sm-3 label-title">Cấp độ</label>
                    <div class="col-sm-9">
                        <input type="text" name="ApplyForm[language_level][]" class="form-control">
                    </div>
                </div>
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-danger language-delete">Xóa</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="language-add" style="display:none;">
        <div style=" overflow: hidden; margin-top: 20px">
            <div class="row form-group">
                <label class="col-sm-3 label-title">Tên</label>
                <div class="col-sm-9">
                    <input type="text" name="ApplyForm[language_name][]" class="form-control" placeholder="English">
                </div>
            </div>
            <div class="row form-group rating">
                <label class="col-sm-3 label-title">Cấp độ</label>
                <div class="col-sm-9">
                    <input type="text" name="ApplyForm[language_level][]" class="form-control">
                </div>
            </div>
            <div class="pull-right">
                <a href="javascript:void(0)" class="btn btn-danger language-delete">Xóa</a>
            </div>
        </div>
    </div>

</div><!-- work-history -->
<?= $this->registerJs('
   $(document).on("click", ".btn-language", function (event){
        var data = $(".language-add").html();
        $(".language-edit").prepend(data);
    });
       $(document).on("click", ".language-delete", function (event){
        $(this).parent().parent().remove();
    });
') ?>