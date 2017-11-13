<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Company;

class AjaxController extends Controller
{

    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionCompany()
    {
        $data = Company::find()
                ->select(['name', 'logo', 'tax_code', 'fullname', 'email', 'address', 'phone', 'about', 'website', 'company_size'])
                ->where(['_id' => $_POST['id']])
                ->one();
        return $this->responseSuccess($data);
    }

    public function actionDay()
    {
//        $number = cal_days_in_month(CAL_GREGORIAN, (int) $_POST['month'], (int) $_POST['year']);
        $data[] = 'Ngày';
        for ($i = 1; $i <= (int) 31; $i++)
        {
            if ($i < 10)
            {
                $i = '0' . $i;
            }
            $data[] = $i;
        }
        return $this->responseSuccess($data);
    }

    public function responseSuccess($data = '', $code = 200, $message = 'Success!')
    {
        $content = [
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ];
        \Yii::$app->response->statusCode = $code;
        return $content;
    }

    public function responseError($code = 403)
    {
        \Yii::$app->response->statusCode = $code;
        $content = [
            'code'    => $code,
            'message' => \Yii::$app->response->statusText
        ];

        return $content;
    }

}
