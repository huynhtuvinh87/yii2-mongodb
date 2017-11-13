<?php

namespace frontend\controllers;

use yii\web\Controller;

class FrontendController extends Controller
{

    public function init()
    {
        parent::init();
        \Yii::$app->mailer->setTransport([
            'class'      => 'Swift_SmtpTransport',
            'host'       => 'smtp.gmail.com',
            'username'   => 'minaworksvn@gmail.com',
            'password'   => 'minaworksvn17',
            'port'       => '587',
            'encryption' => 'tls'
        ]);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    protected function sendmailActive($data)
    {
        $send = \Yii::$app->mailer->compose('active', ['data' => $data])
                ->setFrom(['huynhtuvinh87@gmail.com' => 'Support'])
                ->setSubject('Xác nhận tài khoản')
                ->setTo($data->email)
                ->send();
    }

}
