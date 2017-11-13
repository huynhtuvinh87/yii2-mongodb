<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use frontend\models\ResumeForm;
use yii\web\NotFoundHttpException;
use common\models\Resume;
use frontend\models\BossApply;
use yii\filters\AccessControl;

class ResumeController extends FrontendController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['update', 'view'],
                'rules' => [
                    [
                        'actions' => ['view', 'update'],
                        'allow'   => true,
                        'roles'   => ['@'],
//                        'matchCallback' => function ($rule, $action)
//                        {
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

    public function actionUpdate()
    {
        if (Yii::$app->user->identity->step < 2)
        {
            Yii::$app->session->setFlash('danger', 'Bạn hãy cập nhật thông tin tài khoản đầy đủ để thực hiện tạo CV!.');
            return $this->redirect(['member/update']);
        }
        $model = new ResumeForm();
        if ($model->load(Yii::$app->request->post()) && $model->savedata())
        {
            Yii::$app->session->setFlash('success', 'Bạn đã cập nhật CV thành công.');
            return $this->redirect(['update']);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionView()
    {
        $model = Resume::findOne(['author_id' => Yii::$app->user->id]);
        return $this->render('view', ['model' => $model]);
    }

    public function actionMember($id)
    {

        $model = $this->findModel($id);
        $apply = new BossApply();
        if ($apply->load(Yii::$app->request->post()) && $apply->savedata())
        {
            Yii::$app->session->setFlash('success', 'Bạn đã thêm ứng viên thành công.');
            return $this->redirect(['member', 'id' => $id]);
        }
        return $this->render('member', ['model' => $model, 'apply' => $apply]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
