<?php

namespace common\models;

use yii\mongodb\ActiveRecord;
use common\models\Account;
use common\models\Location;
use common\models\Candidate;
use yii\web\UploadedFile;

/**
 * Work model
 *
 * @property string $auth_id
 * @property string $institute_name
 * @property string $degree
 * @property string $time_period
 * @property string $description
 */
class Resume extends ActiveRecord
{

    public static function collectionName()
    {
        return 'resume';
    }

    public function attributes()
    {
        return [
            '_id',
            'author_id',
            'name',
            'information',
            'career_objective',
            'birthday',
            'birth_place',
            'gender',
            'nationality',
            'location',
            'address',
            'permanent_residence',
            'father_name',
            'mother_name',
            'works',
            'education',
            'language',
            'qualification',
            'declaration',
            'photo',
            'expected_salary',
            'category',
            'program',
            'framework',
            'created_at',
            'updated_at'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'information', 'author_id'], 'default'],
            [['career_objective', 'declaration', 'qualification', 'father_name', 'mother_name', 'birthday', 'birth_place', 'gender', 'nationality', 'location', 'address', 'expected_salary', 'category', 'program', 'framework'], 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [
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

//    public function beforeSave($insert) {
//        if (parent::beforeSave($insert)) {
//            $this->author_id = \Yii::$app->user->id;
//        }
//    }

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

    public function getCities()
    {
        $model = Location::find()->all();
        $data = [];
        foreach ($model as $value)
        {
            $data[$value->title] = $value->title;
        }
        return $data;
    }

    public function getId()
    {
        return (string) $this->_id;
    }

    public function photo()
    {
        return !empty($this->photo) ? '/uploads/cv/' . $this->photo : '/uploads/avatar/user.jpg';
    }

    public function getUser()
    {
        return $this->hasOne(Account::className(), ['_id' => 'author_id']);
    }

    public static function findArray($id)
    {
        return self::find($id)->asArray()->one();
    }

    public function checkCandidate()
    {
        $model = Candidate::findOne(['resume._id' => $this->_id]);
        return $model ? $model : FALSE;
    }

}
