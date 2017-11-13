<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Account;
use common\components\Constant;

/**
 * Login form
 */
class LoginForm extends Model
{

    public $email;
    public $password;
    public $rememberMe = true;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Email không được rỗng.'],
            ['email', 'email', 'message' => 'Email không phải là địa chỉ email hợp lệ.'],
            ['password', 'required', 'message' => 'Mật khẩu không được rỗng.'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Email hoặc mật khẩu không đúng.');
            }
            if (!$user || $user->status == Constant::ACCOUNT_STATUS_NOACTIVE)
            {
                $this->addError($attribute, 'Tài khoản của bạn chưa kích hoạt.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
        {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else
        {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null)
        {
            $this->_user = Account::findByEmail($this->email);
        }

        return $this->_user;
    }

}
