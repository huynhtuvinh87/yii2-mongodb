<?php

namespace frontend\models;

use common\models\Setting;

class SettingConfig extends Setting
{

    public $title;
    public $description;
    public $website;
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['title'], 'required'],
            [['title', 'description', 'website'], 'string'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function metaKeys()
    {
        return ['title', 'description', 'website'];
    }

    public static function find()
    {
        return parent::find()->where(['setting.type' => 'general']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(
                parent::attributeLabels(), [
                ]
        );
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->name = 'General';
            $this->type = 'general';
            return true;
        }
        return false;
    }

}
