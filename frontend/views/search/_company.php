<div class="job-item" style="display: block">
    <div class="row">
        <div class="col-lg-12">
            <div class="extra-info job-name"><a href="javascript:void(0)" data-href="<?= Yii::$app->urlManager->createAbsoluteUrl([$model->type . '/' . $model->slug]) ?>" target="_blank" title="<?= $model->title ?>"><?= $model->title ?></a></div>
            <?= !empty($model->tax_code) ? "<p>Mã số thuế: " . $model->tax_code . "</p>" : "" ?>
            <?= !empty($model->fields) ? "<p>Lĩnh vực kinh doanh: " . $model->fields . "</p>" : "" ?>
        </div>
        <div class="col-lg-12">
            <div class="extra-info job-location"><i class="fa fa-map-marker"></i>
                <?= $model->location_info['title'] ?>
            </div>
        </div>

    </div>
</div>