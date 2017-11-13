<?php

use yii\bootstrap\Html;
?>
<div class="item-info">
    <div class="item-image-box">
        <div class="item-image">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["/resume/member/" . $model->id]) ?>"><img src="<?= $model->user->avatar ?>" alt="Image" class="img-responsive"></a>
        </div><!-- item-image -->
    </div>

    <div class="ad-info">
        <h4>
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["/resume/member/" . $model->id]) ?>" class="title"><?= $model->user->name ?></a>
        </h4>
        <div class="ad-meta">

            <ul>
                <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["member/filter?location=" . $model->location['slug']]) ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $model->location['title'] ?> </a></li>
                <li>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <?php
                    $arr = [];
                    foreach ($model->category as $value)
                    {

                        $arr[] = '<a href="' . Yii::$app->urlManager->createAbsoluteUrl(["member/filter?category=" . $value['slug']]) . '">' . $value['title'] . '</a>';
                    }
                    echo implode(', ', $arr);
                    ?>
                </li>
            </ul>
        </div>
        <div class="ad-action">
            <p>
                <?= nl2br($model->qualification) ?>
            </p>
        </div><!-- ad-meta -->		

    </div><!-- ad-info -->

</div><!-- item-info -->