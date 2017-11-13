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

class FilterJob extends Widget {

    public function run() {
        $model = new JobFilter();
        $category = \common\models\Category::find()->all();
        if (Yii::$app->request->getQueryParams()) {
            $model->attributes = Yii::$app->request->getQueryParams();
        }

        return $this->render("filterjob", ['model' => $model, 'category' => $category]);
    }

}
