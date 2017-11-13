<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\JobFilter;

class SearchWidget extends Widget {

    public function run() {
        $model = new JobFilter();
        return $this->render("search_index", ['model' => $model]);
    }

}
