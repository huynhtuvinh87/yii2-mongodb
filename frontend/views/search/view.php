<?php

$link = Yii::$app->urlManager->createAbsoluteUrl([$model->type . '/' . $model->slug]);
\Yii::$app->view->registerMetaTag([
    'name'    => 'description',
    'content' => $model->content
]);
\Yii::$app->view->registerMetaTag([
    'name'    => 'keywords',
    'content' => 'cho thuê, mua bán, nhà đất, cho thuê, cần thuê, cần mua, cần bán, bất động sản, việc làm, công ty, php, việc làm php, mobile, ios, android...'
]);
\Yii::$app->view->registerMetaTag([
    'name'    => 'author',
    'content' => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam'
]);
\Yii::$app->view->registerMetaTag([
    'name'    => 'web_author',
    'content' => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:locale',
    'content'  => 'vi_VN'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:type',
    'content'  => 'website'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content'  => $model->title
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content'  => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam: mua bán nhà đất, cho thuê nhà đất, văn phòng, căn hộ, biệt thự, cổng thông tin việc làm, việc làm lập trình php, việc làm lập trình mobile, thông tin công ty, địa chỉ công ty'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content'  => $link
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:site_name',
    'content'  => 'Kênh thông tin tìm kiếm số 1 tại Việt Nam'
]);
\Yii::$app->view->registerLinkTag([
    'rel'     => 'canonical',
    'content' => $link
]);
\Yii::$app->view->registerLinkTag([
    'rel'      => 'alternate',
    'hreflang' => 'vi-vn',
    'content'  => $link
]);
?>
<?= $this->registerJs("
$(document).ready(function() {
    setTimeout(function(){
        window.location.href = '" . $model->url . "';
}, 500);
});
") ?>