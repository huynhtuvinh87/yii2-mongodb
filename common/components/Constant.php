<?php

/**
 * Created by PhpStorm.
 * User: huynhtuvinh87
 * Date: 5/24/17
 * Time: 17:08
 */

namespace common\components;

use common\models\ProgrammingLanguage;
use common\models\Category;
use common\models\Framework;
use common\models\Company;
use common\models\Location;

class Constant
{

    const ACCOUNT_STATUS_NOACTIVE = 1; //tài khoản chưa kích hoạt
    const ACCOUNT_STATUS_ACTIVE = 2; //tài khoản kích hoạt
    const ACCOUNT_STATUS_ACTIVE_APPLY = 3; //tài khoản kích hoạt
    const ACCOUNT_STATUS_BLOCK = 4; //tài khoản đã bị khóa
    const ACCOUNT_ROLE_MEMBER = 'member';
    const ACCOUNT_ROLE_BOSS = 'boss';
    const JOB_STATUS_PENDING = 1;
    const JOB_STATUS_ACTIVE = 2;
    const JOB_STATUS_CLOSE = 3;
    const ACCOUNT_STEP_ACTIVE = 1;
    const ACCOUNT_STEP_PROFILE = 2;
    const ACCOUNT_STEP_RESUME = 3;
    const JOB_TYPE_FULLTIME = 1;
    const JOB_TYPE_PATHTIME = 2;
    const JOB_TYPE_FREELANCER = 3;
    const JOB_TYPE_CONTACT = 4;
    const JOB_STATUS = [
        1 => 'Chờ duyệt',
        2 => 'Đã duyệt',
        3 => 'Đóng'
    ];
    const JOB_TYPE = [
        1 => 'Toàn thời gian',
        2 => 'Bán thời gian',
        3 => 'Việc tự do',
        4 => 'Liên hệ'
    ];
    const ACCOUNT_STATUS = [
        1 => 'Chưa kích hoạt',
        2 => 'Kích hoạt',
        3 => 'Kích hoạt và apply',
        4 => 'Khóa'
    ];

    public static function category()
    {
        $category = Category::find()->all();
        if (!empty($category))
        {
            foreach ($category as $key => $value)
            {
                $data[$value->id] = $value->title;
            }
            return $data;
        }
    }

    public function program($array = [])
    {
        $model = ProgrammingLanguage::find()->all();
        if (!empty($model))
        {
            foreach ($model as $key => $value)
            {
                if ($array && in_array($value->id, $array))
                    $checked = 1;
                else
                    $checked = 0;
                $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
            }
            return $data;
        }
    }

    public function framework($array = [])
    {
        $model = Framework::find()->all();
        if (!empty($model))
        {
            foreach ($model as $key => $value)
            {
                if ($array && in_array($value->id, $array))
                    $checked = 1;
                else
                    $checked = 0;
                $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
            }
            return $data;
        }
    }

    public function location()
    {
        $model = Location::find()->all();
        $data = [];
        foreach ($model as $value)
        {
            $data[$value->id] = $value->title;
        }
        return $data;
    }

    public function company()
    {
        $model = Company::find()->where(['author_id' => \Yii::$app->user->id])->all();
        $data[""] = 'Chọn công ty';
        foreach ($model as $value)
        {
            $data[$value->id] = $value->name;
        }
        return $data;
    }

    public function excerpt($str, $length)
    {
        $str = strip_tags($str, '');
        if (strlen($str) < $length)
            return $str;
        else
        {
            $str = strip_tags($str);
            $str = substr($str, 0, $length);
            $end = strrpos($str, ' ');
            $str = substr($str, 0, $end);
            return $str . '...';
        }
    }

}
