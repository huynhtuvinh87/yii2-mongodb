<?php

namespace common\models;

use yii\mongodb\ActiveRecord;
use common\models\Account;
use common\models\Location;
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
class Apply extends ActiveRecord
{

    public static function collectionName()
    {
        return 'apply';
    }

    public function attributes()
    {
        return [
            '_id',
            'boss',
            'member',
            'why_choose_us',
            'resume',
            'job',
            'price',
            'type',
            'created_at',
            'updated_at'
        ];
    }

    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['type'], 'string'],
            [['resume', 'job_id', 'job'], 'default']
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

    public function getId()
    {
        return (string) $this->_id;
    }


}
