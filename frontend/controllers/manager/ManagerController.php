<?php

namespace frontend\controllers\manager;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class ManagerController extends Controller
{

    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['index', 'update', 'create', 'delete', 'view', 'status', 'password'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'create', 'delete', 'view', 'status', 'password'],
                        'allow'   => true,
                        'roles'   => ['@']
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'status' => ['post'],
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

}
