<?php

namespace frontend\models;

use common\models\Account;
use common\models\Resume;
use yii\base\Model;

class Sendmail extends Model {

    public function init() {
        parent::init();
        \Yii::$app->mailer->setTransport([
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'minaworksvn@gmail.com',
            'password' => 'minaworksvn17',
            'port' => '587',
            'encryption' => 'tls'
        ]);
    }

    public static function send($layout, $subject, $to, $data) {
        $send = \Yii::$app->mailer->compose($layout, ['data' => $data])
                ->setFrom(['huynhtuvinh87@gmail.com' => 'Support'])
                ->setSubject($subject)
                ->setTo($to)
                ->send();
    }

}
