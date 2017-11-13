<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Account;

class MemberMenu extends Widget
{

    public function run()
    {
        $model = Account::findProfile();
        return $this->render('member_menu', ['model' => $model]);
    }

}

?>
