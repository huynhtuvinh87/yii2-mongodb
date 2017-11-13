<?php
$this->title = 'Cập nhâp hồ sơ';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class=" job-bg ad-details-page">
    <div class="container">
        <?= \frontend\widgets\MemberMenu::widget() ?>
        <div class="adpost-details post-resume">
            <div class="row">	
                <div class="col-md-12">
                    <?= $this->render('_form', ['model' => $model]) ?>
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
