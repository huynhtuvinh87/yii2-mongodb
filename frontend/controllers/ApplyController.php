<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use frontend\models\ApplyForm;
use common\models\Job;
use yii\web\NotFoundHttpException;
use common\models\Apply;

class ApplyController extends FrontendController {

    public function behaviors() {
        return [
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionCreate($id) {
        $job = Job::findArray($id);
        if ($apply = Apply::findOne(['job.id' => $id])) {
            return $this->redirect(['update', 'id' => $apply->id]);
        }
        $model = new ApplyForm();
        $model->job = $job;
        if ($model->load(Yii::$app->request->post()) && $apply = $model->saveData()) {
            Yii::$app->session->setFlash('success', 'Bạn đã apply thành công.');
            return $this->redirect(['view', 'id' => $apply->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = new ApplyForm(['_id' => $id]);
        if ($model->load(Yii::$app->request->post()) && $apply = $model->saveData()) {
            Yii::$app->session->setFlash('success', 'Bạn đã cập nhật thành công.');
            return $this->redirect(['view', 'id' => $apply->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionView($id) {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Apply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
