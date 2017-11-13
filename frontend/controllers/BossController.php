<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use frontend\models\PasswordForm;
use frontend\models\ProfileBoss;
use common\models\Job;
use common\models\Apply;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class BossController extends FrontendController {

    public function init() {
        
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile', 'update', 'password', 'job'],
                'rules' => [
                    [
                        'actions' => ['profile', 'update', 'password', 'job'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Account::isBoss();
                        }
                    ],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionProfile() {
        $model = Account::findProfile();
        return $this->render('profile', ['model' => $model]);
    }

    public function actionUpdate() {
        $profile = new ProfileBoss();
        if ($profile->load(Yii::$app->request->post()) && $profile->profile()) {
            Yii::$app->session->setFlash('success', 'Bạn đã cập nhật thông tin cá nhần thành công.');
            $this->redirect(['update']);
        }
        return $this->render('update', ['profile' => $profile]);
    }

    public function actionPassword() {
        $model = new PasswordForm();
        $user = Account::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->user->logout();
            $this->redirect(['site/login']);
        }
        return $this->render('password', ['model' => $model, 'user' => $user]);
    }

    public function actionJob() {
        $user = Account::findProfile();
        $dataProvider = new ActiveDataProvider([
            'query' => Job::find()->where(['author_id' => Yii::$app->user->id])->orderBy('created_at ASC'),
            'pagination' => [
                'defaultPageSize' => 50
            ],
        ]);
        $count = Job::find()->where(['author_id' => $user->id])->count();
        return $this->render('job', ['user' => $user, 'dataProvider' => $dataProvider, 'count' => $count]);
    }

      public function actionJobapply() {
        $user = Account::findProfile();
        $dataProvider = new ActiveDataProvider([
            'query' => Apply::find()->where(['boss._id' => $user->_id])->orderBy('created_at ASC'),
            'pagination' => [
                'defaultPageSize' => 20
            ],
        ]);
        $count = Apply::find()->where(['boss._id' => $user->_id])->count();
        return $this->render('/member/job', ['user' => $user, 'dataProvider' => $dataProvider, 'count' => $count]);
    }
}
