<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\widgets\Breadcrumbs;
?>
<div class="breadcrumb-section">
    <!-- breadcrumb -->
    <?=
    Breadcrumbs::widget([
        'tag'      => "ol",
        'homeLink' => [
            'label' => 'Trang chủ',
            'url'   => Yii::$app->homeUrl,
        ],
        'links'    => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>						
    <h2 class="title"><?= $this->title ?></h2>
</div>
