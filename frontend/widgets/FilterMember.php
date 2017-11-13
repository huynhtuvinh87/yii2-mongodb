<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\MemberFilter;

class FilterMember extends Widget {

    public function run() {
        $model = new MemberFilter();

        if (Yii::$app->request->getQueryParams()) {
            $model->attributes = Yii::$app->request->getQueryParams();
        }

        return $this->render("filtermember", ['model' => $model]);
    }

}
