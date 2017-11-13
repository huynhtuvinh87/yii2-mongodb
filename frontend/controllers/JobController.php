<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use frontend\models\JobForm;
use frontend\models\JobFilter;
use common\models\Job;
use frontend\models\MemberApply;
use frontend\models\Sendmail;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\controllers\FrontendController;

class JobController extends FrontendController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['create', 'update', 'view', 'status'],
                'rules' => [
                    [
                        'actions'       => ['create', 'update', 'view', 'status'],
                        'allow'         => true,
                        'roles'         => ['@'],
//                        'matchCallback' => function ($rule, $action)
//                        {
//                            return Account::isBoss();
//                        }
                    ],
                ],
            ],
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'status' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $params = Yii::$app->request->getQueryParams();
        $fillter = new JobFilter(['params' => $params]);
        $dataProvider = $fillter->fillter($params);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionFilter()
    {
        $params = Yii::$app->request->getQueryParams();
        $search = new JobFilter(['params' => $params]);
        $dataProvider = $search->fillter($params);
        $this->view->title = 'Tìm kiếm';
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'search'       => $search
        ]);
    }

    public function actionCategory($slug)
    {
        $params = Yii::$app->request->getQueryParams();
        $params['category'] = $slug;
        $search = new JobFilter(['params' => $params]);
        $dataProvider = $search->fillter($params);
        $this->view->title = 'Tìm kiếm';
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'search'       => $search
        ]);
    }

    public function actionCreate()
    {
        $user = Account::findProfile();
        $model = new JobForm();
        if ($model->load(Yii::$app->request->post()) && $job = $model->savedata())
        {
//            Sendmail::send('job', 'Đăng việc thành công', $job->user->email, $job->user);
            Yii::$app->session->setFlash('success', 'Bạn đã thêm công việc thành công.');
            return $this->redirect(['boss/job']);
        }
        return $this->render('create', ['model' => $model, 'user' => $user]);
    }

    public function actionUpdate($id)
    {

        $user = Account::findProfile();
        $model = new JobForm(['_id' => $id]);
        if ($model->load(Yii::$app->request->post()) && $model->savedata())
        {
            Yii::$app->session->setFlash('success', 'Bạn đã cập nhật công việc thành công.');
            return $this->redirect(['boss/job']);
        }

        return $this->render('update', ['model' => $model, 'user' => $user]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user = Account::findOne($id);
        return $this->render('view', ['model' => $model, 'user' => $user]);
    }

    public function actionDetail($slug)
    {
        $model = Job::findOne(['slug' => $slug]);
        if (!$model)
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $apply = new MemberApply(['_job' => $model]);
        if ($apply->load(Yii::$app->request->post()) && $apply->savedata())
        {
            Yii::$app->session->setFlash('success', 'Bạn đã apply công việc thành công.');
            return $this->redirect(['job/' . $slug]);
        }
        return $this->render('detail', ['model' => $model, 'apply' => $apply]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionStatus($id)
    {
        $model = $this->findModel($id);
        $model->status = $model->status ? Job::STATUS_ACTIVE : Job::STATUS_CLOSE;
        $model->save();
        Yii::$app->session->setFlash('success', 'Bạn đã đóng công việc thành công.');
        return $this->redirect(['index']);
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
        if (($model = Job::findOne(['_id' => $id, 'author_id' => \Yii::$app->user->id])) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
