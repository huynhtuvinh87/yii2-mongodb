<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/theme';
    public $css = [
        'https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300',
        'https://fonts.googleapis.com/css?family=Signika+Negative:400,300,600,700',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css',
        'css/font-awesome.min.css',
        'css/icofont.css',
        'css/slidr.css',
        'css/main.css',
        'css/responsive.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js',
        'js/price-range.js',
        'js/main.js',
        'js/switcher.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
