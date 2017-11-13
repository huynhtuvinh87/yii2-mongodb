<?php

namespace frontend\controllers;

use Yii;
use common\models\Company;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use frontend\controllers\FrontendController;

class CompanyController extends FrontendController
{

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query'      => Company::find()->where(['author_id' => Yii::$app->user->id])->orderBy('created_at DESC'),
            'pagination' => [
                'defaultPageSize' => 20
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider,]);
    }

    public function actionCreate()
    {
        $model = new Company();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', 'Bạn đã thêm Công ty thành công.');
            return $this->redirect(['create']);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', 'Bạn đã cập nhật Công ty thành công.');
            return $this->redirect(['update', 'id' => $id]);
        }

        return $this->render('update', ['model' => $model]);
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
        if (($model = Company::findOne(['_id' => $id, 'author_id' => \Yii::$app->user->id])) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
