<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title                   = \Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'Post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">
    <div class="row">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
</div>