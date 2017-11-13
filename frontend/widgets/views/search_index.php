<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="banner-job">
    <div class="banner-overlay"></div>
    <div class="container text-center">
        <h1 class="title">Cách dễ nhất để nhận công việc mới của bạn</h1>
        <h3>Chúng tôi cung cấp 12000 việc làm ngay bây giờ</h3>
        <div class="banner-form">
            <?php
            $form = \yii\widgets\ActiveForm::begin([
                'id' => 'jobFilter',
                'method' => 'get',
                'action' => ['/job/filter'],
            ]);
            ?>
            <input type="text" class="form-control" name="keywords" placeholder="Từ khoá tìm kiếm">
            <input id="search-location" type="hidden" name="location">
            <div class="dropdown category-dropdown">						
                <a data-toggle="dropdown" href="#"><span class="change-text">Địa điểm </span> <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu category-change">
                    <?php
                    foreach ($model->_location as $value) {
                        ?>
                        <li><a href="#" data="<?= $value->slug ?>"><?= $value->title ?></a></li>
                        <?php
                    }
                    ?>

                </ul>								
            </div><!-- category-change -->
            <button type="button" class="btn btn-primary" value="Search">Tìm kiếm</button>
            <?php $form->end(); ?>
        </div><!-- banner-form -->

        <ul class="banner-socail list-inline">
            <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#" title="Youtube"><i class="fa fa-youtube"></i></a></li>
        </ul><!-- banner-socail -->
    </div><!-- container -->
</div><!-- banner-section -->
<?=
$this->registerJs('
    $(document).ready(function(){
    $("#jobFilter").on("click", "button:button", function(){
        $("#jobFilter").submit();
    });
});
        ');
?>

