<?php

use yii\bootstrap\Html;
use common\components\Constant;
?>
<div class="item-info">
    <div class="item-image-box">
        <div class="item-image">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["job/" . $model->slug]) ?>"><img src="<?= $model->company['logo'] ?>" alt="Image" class="img-responsive"></a>
        </div><!-- item-image -->
    </div>

    <div class="ad-info">
        <span>
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["job/" . $model->slug]) ?>" class="title"><?= $model->title ?> <small>(<?= $model->deadline() ?>)</small></a>
        </span>
        <div class="ad-meta">
            <ul>
                <li><a href="/job/filter?location=<?= $model->location['slug'] ?>"><i class="fa fa-map-marker" aria-hidden="true"></i><?= $model->location['title'] ?> </a></li>
                <li class="type"><a href="/job/filter?sell=<?= $model->sell_type ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?= Constant::JOB_TYPE[$model->sell_type] ?></a></li>
                <li><a href="#"><i class="fa fa-money" aria-hidden="true"></i><?= $model->price ?></a></li>
                <li><a href="/job/filter?sell=<?= $model->category['slug'] ?>"><i class="fa fa-tags" aria-hidden="true"></i><?= $model->category['title'] ?></a></li>
            </ul>
        </div>
        <div class="ad-action">
        </div><!-- ad-meta -->		

    </div><!-- ad-info -->

</div><!-- item-info -->