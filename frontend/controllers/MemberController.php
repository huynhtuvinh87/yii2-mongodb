<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use frontend\models\PasswordForm;
use frontend\models\ProfileMember;
use common\models\Apply;
use frontend\models\MemberApply;
use common\models\Job;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use frontend\models\MemberFilter;

class MemberController extends FrontendController
{

    public function init()
    {
        
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['profile', 'update', 'password', 'job'],
                'rules' => [
                    [
                        'actions' => ['profile', 'update', 'password', 'job'],
                        'allow'   => true,
                        'roles'   => ['@'],
//                        'matchCallback' => function ($rule, $action) {
//                            return Account::isMember();
//                        }
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $params = Yii::$app->request->getQueryParams();
        $fillter = new MemberFilter(['params' => $params]);
        $dataProvider = $fillter->fillter($params);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionFilter()
    {
        $params = Yii::$app->request->getQueryParams();
        $search = new MemberFilter(['params' => $params]);
        $dataProvider = $search->fillter($params);
        $this->view->title = 'Tìm kiếm hồ sơ';
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'search'       => $search
        ]);
    }

    public function actionProfile()
    {
        $model = Account::findProfile();
        return $this->render('profile', ['model' => $model]);
    }

    public function actionUpdate()
    {
        $model = Account::findProfile();
        $profile = new ProfileMember();
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

    public function actionClose()
    {
        $model = Account::findProfile();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->status = Account::PUBLISH_CLOSE;
            $model->save();
            $this->redirect(['close']);
        }
        return $this->render('close', ['model' => $model]);
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

    public function actionJob()
    {
        $user = Account::findProfile();
        $dataProvider = new ActiveDataProvider([
            'query'      => Job::find()->where(['author_id' => Yii::$app->user->id])->orderBy('created_at ASC'),
            'pagination' => [
                'defaultPageSize' => 50
            ],
        ]);
        $count = Job::find()->where(['author_id' => $user->id])->count();
        return $this->render('job', ['user' => $user, 'dataProvider' => $dataProvider, 'count' => $count]);
    }

}
