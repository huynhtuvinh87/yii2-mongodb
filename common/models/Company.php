<?php

namespace common\models;

use yii\mongodb\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Location model
 *
 * @property string $name
 * @property string $sectors
 */
class Company extends ActiveRecord
{

    public static function collectionName()
    {
        return 'company';
    }

    public function rules()
    {
        return [
            [['name', 'tax_code', 'about', 'email', 'address', 'company_size', 'phone'], 'required'],
            [['name', 'tax_code', 'about', 'email', 'address', 'company_size', 'website'], 'string'],
            ['logo', 'file']
        ];
    }

    public function attributes()
    {
        return [
            '_id',
            'author_id',
            'name',
            'logo',
            'tax_code',
            'email',
            'address',
            'phone',
            'about',
            'company_size',
            'website',
            'created_at',
            'updated_at'
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'         => 'Tên công ty',
            'email'        => 'Email',
            'tax_code'     => 'Mã số thuế',
            'address'      => 'Địa chỉ',
            'phone'        => 'Điện thoại',
            'about'        => 'Giới thiệu',
            'company_size' => 'Quy mô công ty',
            'city'         => 'Tỉnh/Thành'
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->author_id = \Yii::$app->user->id;
            $logo = UploadedFile::getInstance($this, 'logo');
            if (!empty($logo))
            {
                $name = 'logo_' . time() . '.' . $logo->extension;
                $logo->saveAs(\Yii::getAlias("@frontend/web/uploads/logo/") . $name);
                $this->logo = '/uploads/logo/' . $name;
            }
            return true;
        }
        return false;
    }

    public function getId()
    {
        return (string) $this->_id;
    }

    public static function findArray($id)
    {
        return self::find($id)->select([
                    'name',
                    'logo',
                    'tax_code',
                    'fullname',
                    'email',
                    'address',
                    'phone',
                    'about',
                    'company_size',
                    'website'
                ])->asArray()->one();
    }

    public function logo()
    {
        return !empty($this->logo) ? $this->logo : '/uploads/avatar/user.jpg';
    }

}
