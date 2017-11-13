<?php

namespace frontend\models;

use common\models\Account;
use common\components\Constant;
use yii\web\UploadedFile;

/**
 * ProfileForm
 */
class ProfileForm extends Account
{

    public $day;
    public $month;
    public $year;
    public $avatar = '/uploads/avatar/user.jpg';

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
            [['city', 'address', 'day', 'month', 'year'], 'string'],
            ['gender', 'integer'],
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

    public function getDays()
    {
        $data[] = 'Ngày';
        for ($i = 1; $i <= 31; $i++)
        {
            if ($i < 10)
            {
                $i = '0' . $i;
            }
            $data[$i] = $i;
        }
        return $data;
    }

    public function getMonths()
    {
        $data[] = 'Tháng';
        for ($i = 1; $i <= 12; $i++)
        {
            if ($i < 10)
            {
                $i = '0' . $i;
            }
            $data[$i] = $i;
        }
        return $data;
    }

    public function getYears()
    {
        $data[] = 'Năm';
        for ($i = 1950; $i <= 2017; $i++)
        {
            $data[$i] = $i;
        }
        return $data;
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
            if (!empty($this->day && $this->month && $this->year))
            {
                $model->birthday = $this->day . '/' . $this->month . '/' . $this->year;
            }
            $model->gender = (int) $this->gender;
            $avatar = UploadedFile::getInstance($this, 'avatar');
            if (!empty($avatar))
            {
                $name = $model->username . '.' . $avatar->extension;
                $avatar->saveAs(\Yii::getAlias("@frontend/web/uploads/avatar/") . $name);
                $model->avatar = '/uploads/avatar/' . $name;
            } else
            {
                $model->avatar = $this->avatar;
            }
            $model->step = Constant::ACCOUNT_STEP_PROFILE;
            if ($model->save())
            {
                return $model;
            }
        }

        return null;
    }

}
