<?php
$form = \yii\widgets\ActiveForm::begin([
            'id'     => 'jobFilter',
            'method' => 'get',
            'action' => ['/job/filter'],
        ]);
$model->category = is_array($model->category) ? $model->category : [$model->category];
$model->program = is_array($model->program) ? $model->program : [$model->program];
$model->framework = is_array($model->framework) ? $model->framework : [$model->framework];
$model->location = is_array($model->location) ? $model->location : [$model->location];
$model->sell = is_array($model->sell) ? $model->sell : [$model->sell];

?>
<input type="hidden" name="keywords" value="<?=$model->keywords?>">
<style>
    .panel-body{
        max-height: 260px; overflow-y: scroll;
    }
</style>
<div class="accordion">
    <!-- panel-group -->
    <div class="panel-group" id="accordion">

        <!-- panel -->
        <div class="panel panel-default panel-faq">
            <!-- panel-heading -->
            <div class="panel-heading">
                <div  class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordion-one">
                        <h4>Danh mục</h4>
                    </a>
                </div>
            </div><!-- panel-heading -->

            <div class="panel-collapse">
                <!-- panel-body -->
                <div class="panel-body">
                    <?php
                    foreach ($model->_category as $value)
                    {

                        $check = !empty($model->category) && in_array($value->slug, $model->category) ? TRUE : FALSE;
                        ?>
                        <div class="checkbox">
                            <label <?= $check ? "class='checked'" : "" ?>>
                                <input type="checkbox" name="category[]" <?= $check ? "checked" : "" ?> value="<?= $value->slug ?>">
                                <?= $value->title ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>


                </div><!-- panel-body -->
            </div>
        </div><!-- panel -->


        <!-- panel -->
        <div class="panel panel-default panel-faq">
            <!-- panel-heading -->
            <div class="panel-heading">
                <div  class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordion-two">
                        <h4>Ngôn ngữ lập trình </h4>
                    </a>
                </div>
            </div><!-- panel-heading -->

            <div class="panel-collapse">
                <div class="panel-body">
                    <?php
                    foreach ($model->_program as $value)
                    {
                        $check = !empty($model->program) && in_array($value->slug, $model->program) ? TRUE : FALSE;
                        ?>
                        <div class="checkbox">
                            <label <?= $check ? "class='checked'" : "" ?>>
                                <input type="checkbox" name="program[]" <?= $check ? "checked" : "" ?> value="<?= $value->slug ?>">
                                <?= $value->title ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </div><!-- panel -->
        <!-- panel -->
        <div class="panel panel-default panel-faq">
            <!-- panel-heading -->
            <div class="panel-heading">
                <div class="panel-title"></div>
                <a data-toggle="collapse" data-parent="#accordion" href="#accordion-framework">
                    <h4>Framework</h4>
                </a>
            </div><!-- panel-heading -->

            <div class="panel-collapse">
                <!-- panel-body -->
                <div class="panel-body">
                    <?php
                    foreach ($model->_framework as $value)
                    {
                        $check = !empty($model->framework) && in_array($value->slug, $model->framework) ? TRUE : FALSE;
                        ?>
                        <div class="checkbox">
                            <label <?= $check ? "class='checked'" : "" ?>>
                                <input type="checkbox" name="framework[]" <?= $check ? "checked" : "" ?> value="<?= $value->slug ?>">
                                <?= $value->title ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>

                </div><!-- panel-body -->
            </div>
        </div> <!-- panel -->

        <!-- panel -->
        <div class="panel panel-default panel-faq">
            <!-- panel-heading -->
            <div class="panel-heading">
                <div class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordion-four">
                        <h4>Hình thức làm việc</h4>
                    </a>
                </div>
            </div><!-- panel-heading -->

            <div class="panel-collapse">
                <!-- panel-body -->
                <div class="panel-body">
                    <?php
                    foreach ($model->_sell as $key => $value)
                    {
                        $check = !empty($model->sell) && in_array($key, $model->sell) ? TRUE : FALSE;
                        ?>
                        <div class="checkbox">
                            <label <?= $check ? "class='checked'" : "" ?>>
                                <input type="checkbox" name="sell[]" <?= $check ? "checked" : "" ?> value="<?= $key ?>">
                                <?= $value ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>

                </div><!-- panel-body -->
            </div>
        </div><!-- panel -->

        <!-- panel -->
        <div class="panel panel-default panel-faq">
            <!-- panel-heading -->
            <div class="panel-heading">
                <div class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#accordion-seven">
                        <h4>Địa điểm</h4>
                    </a>
                </div>
            </div><!-- panel-heading -->

            <div class="panel-collapse">
                <!-- panel-body -->
                <div class="panel-body">
                    <?php
                    foreach ($model->_location as $value)
                    {
                        $check = !empty($model->location) && in_array($value->slug, $model->location) ? TRUE : FALSE;
                        ?>
                        <div class="checkbox">
                            <label <?= $check ? "class='checked'" : "" ?>>
                                <input type="checkbox" name="location[]" <?= $check ? "checked" : "" ?> value="<?= $value->slug ?>">
                                <?= $value->title ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>

                </div><!-- panel-body -->
            </div>
        </div> <!-- panel -->

    </div><!-- panel-group -->
</div>
<?php $form->end(); ?>
<?=
$this->registerJs('
    $(document).ready(function(){
    $("#jobFilter").on("change", "input:checkbox", function(){
        $("#jobFilter").submit();
    });
});
        ');
?>

