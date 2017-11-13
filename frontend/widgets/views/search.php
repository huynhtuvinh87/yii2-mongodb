<?php

use yii\helpers\Html;
?>
<form id="searchbox" action="/search" class="form-horizontal" method="get">
    <div class="form-group">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">
            <?= Html::textInput('keywords', $model->keywords, ['class' => 'form-control', 'placeholder' => \Yii::t('app', 'Keywords')]) ?>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">
            <?= Html::dropDownList('type', $model->type, $model->getTypes(), ['class' => 'form-control', 'id' => 'type']) ?>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">
            <?= Html::dropDownList('location', $model->location, $model->locations, ['class' => 'form-control']) ?>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12 fr-search">
            <button type="button" class="btn btn-success filter"><?= \Yii::t('app', 'Filter') ?></button>
            <button type="submit" class="btn btn-primary pull-right"><?= \Yii::t('app', 'Search') ?></button>
        </div>
    </div>
    <div class="form-group subcategory">
        <?php
        if (!empty($model->categories))
        {
            foreach ($model->categories as $value)
            {

                if (!empty($model->category) && in_array($value->slug, $model->category))
                {
                    $check = "checked";
                } else
                {
                    $check = "";
                }
                ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12"><div class="checkbox"><label><input type="checkbox" <?= $check ?> name="category[]" value="<?= $value->slug ?>"><?= $value->title ?></label></div></div>
                            <?php
                        }
                    }
                    ?>
    </div>	
</form>
<?= $this->registerJs('
$("#type").on("change",function(){    
 $.ajax({
   url:"' . Yii::$app->urlManager->createUrl(["ajax/category"]) . '",
   type:"POST",            
   data:"type="+$("#type option:selected").val(),
   dataType:"json",
   success:function(res){     

         if(res.data){
         var html="";
         for (i = 0; i < res.data.length; ++i) {
         html += "<div class=\"col-lg-3\"><div class=\"checkbox\"><label><input type=\"checkbox\" name=\"category[]\" value="+res.data[i].slug+">"+res.data[i].title+"</label></div></div>";
}    
         }
               $(".subcategory").html(html);
       } 
      });
    });

');
?>
<?= $this->registerCss("
            .subcategory{
                display:none;
            }
            .open{
                display:block;
            }
") ?>