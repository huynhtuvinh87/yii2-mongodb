<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?= Yii::$app->urlManager->createAbsoluteUrl('/images/icon/favicon.ico') ?>">
        <?php $this->head() ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Template Developed By ThemeRegion -->
        <style>
            #yii-debug-toolbar{
                display: none !important
            }
            section{
                padding: 0
            }
        </style>
    </head>
    <body>
        <?php $this->beginBody() ?>

        
        <?= $content ?>
  
        
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
