<?php

namespace backend\controllers;

use Yii;
use common\models\Job;
use backend\models\JobSearch;
use yii\web\NotFoundHttpException;
use backend\components\BackendController;

class JobController extends BackendController
{

    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $search = new JobSearch();
        $dataProvider = $search->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'search'       => $search
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostJob();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index', 'page' => $this->page]);
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()))
        {
            $model->status = (int) $model->status;
            $model->save();
            \Yii::$app->session->setFlash('success', 'Bạn đã thay đổi trạng thái thành công');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionDoaction()
    {
        if (!empty($_POST['selection']) && !empty($_POST['action']) && ($_POST['action'] == "delete"))
        {
            foreach ($_POST['selection'] as $value)
            {
                $this->findModel($value)->delete();
            }
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Delete success'));
        }
        if (!empty($_POST['action']) && ($_POST['action'] == "price"))
        {
            foreach ($_POST['price'] as $k => $value)
            {
                $model = $this->findModel($k);
                $model->fake = (int) $_POST['price'][$k];
                $model->price = (int) $_POST['price'][$k];
                $model->save();
            }
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Price success'));
            return $this->redirect(['index']);
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
