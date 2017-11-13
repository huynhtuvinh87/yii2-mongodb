<?php

namespace frontend\controllers\manager;

use Yii;
use common\models\Account;
use frontend\models\JobForm;
use common\models\Job;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class JobController extends ManagerController
{


    public function actionIndex()
    {
        $user = Account::findProfile();
        $dataProvider = new ActiveDataProvider([
            'query'      => Job::find()->where(['author_id' => Yii::$app->user->id])->orderBy('created_at ASC'),
            'pagination' => [
                'defaultPageSize' => 50
            ],
        ]);
        $count = Job::find()->where(['author_id' => $user->id])->count();
        return $this->render('index', ['user' => $user, 'dataProvider' => $dataProvider, 'count' => $count]);
    }

    public function actionCreate()
    {
        $user = Account::findProfile();
        $model = new JobForm();
        if ($model->load(Yii::$app->request->post()) && $job = $model->savedata())
        {
//            Sendmail::send('job', 'Đăng việc thành công', $job->user->email, $job->user);
            Yii::$app->session->setFlash('success', 'Bạn đã thêm công việc thành công.');
            return $this->redirect(['index']);
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
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model, 'user' => $user]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user = Account::findOne($id);
        return $this->render('view', ['model' => $model, 'user' => $user]);
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
