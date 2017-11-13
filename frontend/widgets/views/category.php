<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<ul class="category-list">	
    <?php
    foreach ($model as $value)
    {
        ?>
        <li class="category-item">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["job/filter?category=" . $value->slug]) ?>">
                <div class="category-icon"><img src="/theme/images/icon/<?= $value->icon ?>" alt="images" class="img-responsive"></div>
                <span class="category-title"><?= $value->title ?></span>
                <span class="category-quantity">(<?= $value->count() ?>)</span>
            </a>
        </li><!-- category-item -->
        <?php
    }
    ?>		
</ul>	