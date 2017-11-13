<div class="job-item" style="display: block">
    <div class="row">
        <div class="col-lg-12">
            <div class="extra-info job-name"><a href="javascript:void(0)" data-href="<?= Yii::$app->urlManager->createAbsoluteUrl([$model->type . '/' . $model->slug]) ?>" target="_blank" title="<?= $model->title ?>"><?= $model->title ?></a></div>
            <p><?= !empty($model->price) ? $model->price . ' - ' : "" ?> <?= \Yii::t('app', 'Date posted') . ': ' . date('d/m/Y', $model->date) ?></p>
            <p><?= nl2br($model->content) ?></p>
            <?= !empty($model->tax_code) ? "<p>Mã số thuế: " . $model->tax_code . "</p>" : "" ?>
            <?= !empty($model->fields) ? "<p>Lĩnh vực kinh doanh: " . $model->fields . "</p>" : "" ?>
        </div>
        <div class="col-lg-12">
            <div class="extra-info job-location"><i class="fa fa-map-marker"></i>
                <?php
                if (!empty($model->location_info))
                {
                    foreach ($model->location_info as $value)
                    {
                        echo $value['location_info']['title'] . '<br>';
                    }
                }
                ?>
            </div>
        </div>

    </div>
</div>