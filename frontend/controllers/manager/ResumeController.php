<?php

namespace frontend\controllers\manager;

use Yii;
use frontend\models\ResumeForm;
use yii\web\NotFoundHttpException;
use common\models\Resume;
use yii\filters\AccessControl;

class ResumeController extends ManagerController
{

    public function actionIndex()
    {
        $model = Resume::findOne(['author_id' => Yii::$app->user->id]);
        return $this->render('index', ['model' => $model]);
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
