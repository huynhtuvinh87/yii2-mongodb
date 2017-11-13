<?php

namespace frontend\models;

use common\models\Account;
use yii\web\UploadedFile;

/**
 * ProfileBoss form
 */
class ProfileBoss extends Account
{

    public function init()
    {
        $model = Account::findProfile();
        $this->attributes = $model->attributes;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['phone', 'integer'],
            ['name', 'filter', 'filter' => 'trim'],
            [['name', 'email'], 'required', 'message' => '{attribute} không được rỗng.'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'validateEmail'],
            [['city', 'address'], 'string'],
            ['avatar', 'file']
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $model = Account::findByEmail($this->email);
            if (!empty($model))
            {
                if ($model->id != \Yii::$app->user->id)
                    $this->addError($attribute, $this->email . ' đã tồn tại trong hệ thống.');
            }
        }
    }

    public function profile()
    {
        if ($this->validate())
        {
            $model = Account::findProfile();
            $model->name = $this->name;
            $model->email = $this->email;
            $model->phone = $this->phone;
            $model->city = $this->city;
            $model->address = $this->address;
            $avatar = UploadedFile::getInstance($this, 'avatar');
            if (!empty($avatar))
            {
                $name = $model->username . '.' . $avatar->extension;
                $avatar->saveAs(\Yii::getAlias("@frontend/web/uploads/avatar/") . $name);
                $model->avatar = $name;
            }
            if ($model->save())
            {
                return $model;
            }
        }

        return null;
    }

}
