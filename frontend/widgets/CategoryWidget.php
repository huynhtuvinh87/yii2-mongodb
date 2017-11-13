<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Category;

class CategoryWidget extends Widget
{

    public function run()
    {
        $model = Category::find()->all();
        return $this->render('category', ['model' => $model]);
    }

}

?>
