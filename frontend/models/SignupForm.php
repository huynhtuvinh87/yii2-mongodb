<?php

namespace frontend\models;

use common\models\Account;
use common\models\Resume;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $name;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 5, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Hai mật khẩu không trùng nhau!'],
            ['role', 'string'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
            $user = new Account();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->username = $this->username;
            $user->created_at = $user->updated_at = time();
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                
                return $user;
            }
        }

        return null;
    }

}
