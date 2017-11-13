<?php

namespace frontend\models;

use common\models\Account;
use Yii;

/**
 * Signup form
 */
class Work extends Account
{

    public $institute_name;
    public $degree;
    public $time_period;
    public $description;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['name', 'filter', 'filter' => 'trim'],
            [['name', 'email'], 'required', 'message' => '{attribute} không được rỗng.'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'validateEmail'],
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $model = User::find()->where(['email' => $this->email])->one();
            if (!empty($model))
            {
                if ($model->id != $this->id)
                    $this->addError($attribute, $this->email . ' đã tồn tại trong hệ thống.');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }

    public function profile()
    {
        if ($this->validate())
        {

            $user = Account::findOne($this->id);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            if ($user->save())
            {
                return $user;
            }
        }

        return null;
    }

}
