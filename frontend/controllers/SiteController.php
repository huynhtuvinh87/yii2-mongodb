<?php

namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Job;
use common\models\Account;
use common\models\Company;
use frontend\models\Sendmail;
use common\components\Constant;
use yii\web\NotFoundHttpException;
use frontend\controllers\FrontendController;

/**
 * Site controller
 */
class SiteController extends FrontendController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'requestpassword'],
                'rules' => [
                    [
                        'actions' => ['signup', 'requestpassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $count_job = Job::find()->count();
        $count_member = Account::find()->where(['role' => 'member'])->count();
        $count_company = Company::find()->count();
        $dataProvider = new ActiveDataProvider([
            'query' => Job::find()->where(['status' => Constant::JOB_STATUS_ACTIVE])->orderBy('updated_at DESC'),
            'pagination' => [
                'defaultPageSize' => 10
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider, 'count_job' => $count_job, 'count_member' => $count_member, 'count_company' => $count_company]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = \common\models\Account::findOne(Yii::$app->user->id);
            $user->login_at = time();
            $user->save();
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->getSession()->destroy();
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(\Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
            Sendmail::send('active', 'Xác nhận tài khoản', $user->email, $user);
            $this->redirect(['active', 'id' => $user->id]);
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionActive() {
        if ($_GET['id']) {
            $user = Account::findOne($_GET['id']);
            $user->status = $user->status == 2 ? TRUE : FALSE;
            return $this->render('active', ['data' => $user]);
        } else {
            $user = Account::findOne(['email' => $_GET['email'], 'auth_key' => $_GET['auth']]);
            if ($user) {
                $user->status = Constant::ACCOUNT_STATUS_ACTIVE;
                $user->step = Constant::ACCOUNT_STEP_ACTIVE;
                $user->save();
                $this->redirect(['login']);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestpassword() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Kiểm tra email của bạn để được hướng dẫn thêm.');
            } else {
                Yii::$app->session->setFlash('error', 'Rất tiếc, chúng tôi không thể đặt lại mật khẩu cho email này.');
            }
            return $this->redirect(['requestpassword']);
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetpassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
