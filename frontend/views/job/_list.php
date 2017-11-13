<?php

use yii\bootstrap\Html;
?>
<div class="item-info">
    <div class="ad-info">
        <h4>
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["job/" . $model->slug]) ?>" class="title"><?= $model->title ?> <small>(<?= $model->deadline() ?>)</small></a>
        </h4>
        <div class="ad-meta">
            <ul>
                <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><?= $model->location['title'] ?> </a></li>
                <li class="type"><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $model->type ?></a></li>
                <li><a href="#"><i class="fa fa-money" aria-hidden="true"></i><?= $model->price ?></a></li>
                <li><a href="#"><i class="fa fa-tags" aria-hidden="true"></i><?= $model->category['title'] ?></a></li>
            </ul>
        </div>
        <div class="ad-action">
            <?=
             Html::a('Chỉnh sửa', ["job/update", 'id' => $model->id], [
                        'class' => 'btn btn-success',
                    ])
            ?>
            <?=
            $model->status()['close'] ? Html::a($model->status()['name'], ["status", 'id' => $model->id], [
                        'class' => 'btn btn-' . $model->status()['success'],
                        'data'  => [
                            'confirm' => 'Bạn có muốn đóng công việc này không?',
                            'method'  => 'post',
                        ],
                    ]) :
                    Html::a($model->status()['name'], '#', [
                        'class' => 'btn btn-' . $model->status()['success'],
                    ])
            ?>
             
        </div><!-- ad-meta -->		

    </div><!-- ad-info -->

</div><!-- item-info -->