<?php

namespace frontend\controllers\manager;

use Yii;
use common\models\Account;
use frontend\models\PasswordForm;
use frontend\models\ProfileForm;

class ProfileController extends ManagerController
{

    public function actionIndex()
    {
        $model = Account::findProfile();
        return $this->render('index', ['model' => $model]);
    }

    public function actionUpdate()
    {
        $model = Account::findProfile();
        $profile = new ProfileForm();
        $profile->attributes = $model->attributes;
        if ($model->birthday)
        {
            $birthday = explode('/', $model->birthday);
            $profile->day = $birthday[0];
            $profile->month = $birthday[1];
            $profile->year = $birthday[2];
        }
        if ($profile->load(Yii::$app->request->post()) && $profile->profile())
        {
            Yii::$app->session->setFlash('success', 'Bạn đã cập nhật thông tin tài khoản thành công.');
            $this->redirect(['update']);
        }
        return $this->render('update', ['profile' => $profile]);
    }

    public function actionPassword()
    {
        if (\Yii::$app->user->isGuest)
            $this->redirect('/dang-nhap?redirect=' . Yii::$app->convert->redirect($_SERVER['REQUEST_URI']));
        $model = new PasswordForm();
        $user = Account::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->user->logout();
            $this->redirect(['site/login']);
        }
        return $this->render('password', ['model' => $model, 'user' => $user]);
    }

}
