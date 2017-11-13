<?php

namespace backend\controllers;

use Yii;
use common\models\Setting;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use backend\components\BackendController;

/**
 * MenuController implements the CRUD actions for Category model.
 */
class SettingController extends BackendController {

    public function behaviors() {
        return parent::behaviors();
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex() {

        $dataProvider = new ActiveDataProvider([
            'query' => Setting::find(),
            'pagination' => [
                'defaultPageSize' => 100
            ],
        ]);
        $model = new Setting();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->key) {
                $model->save();
            }
            if (!empty($_POST['value'])) {
                foreach ($_POST['value'] as $k => $order) {
                    $setting = Setting::findOne($k);
                    $setting->value = $_POST['value'][$k];
                    $setting->save();
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
