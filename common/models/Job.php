<?php

namespace common\models;

use yii\mongodb\ActiveRecord;
use common\components\Constant;
use Yii;

class Job extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return[
            [['title', 'description', 'author_id', 'responsibilities', 'request', 'author_id'], 'string'],
            [['category', 'company', 'program', 'framework', 'location', 'deadline'], 'default'],
            ['status', 'default', 'value' => Constant::JOB_STATUS_PENDING],
            [['price_min', 'price_max', 'price_negotiable', 'sell_type', 'status'], 'integer']
        ];
    }

    public function attributes()
    {
        return [
            '_id',
            'author_id',
            'company',
            'title',
            'slug',
            'description',
            'price_min',
            'price_max',
            'price_negotiable',
            'request',
            'responsibilities',
            'status',
            'location',
            'category',
            'program',
            'framework',
            'sell_type',
            'deadline',
            'created_at',
            'updated_at'
        ];
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

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp'    => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'slugBehavior' => [
                'class'     => \common\components\SluggableBehavior::className(),
                'attribute' => 'title'
            ],
        ]);
    }

    public function getUser()
    {
        return $this->hasOne(Account::className(), ['_id' => 'author_id']);
    }

    public function getId()
    {
        return (string) $this->_id;
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createAbsoluteUrl(['/' . $this->slug]);
    }

    public function getType()
    {
        return str_replace('_', " ", $this->sell_type);
    }

    public function getPrice()
    {
        return $this->price_negotiable == 1 ? "Thương lượng" : number_format($this->price_min, 0, ",", ".") . ' - ' . number_format($this->price_max, 0, ",", ".");
    }

    public function logo()
    {
        return !empty($this->information['logo']) ? '/uploads/logo/' . $this->information['logo'] : '/uploads/logo/default.png';
    }

    public function deadline()
    {
        $current_time = date('Y-m-d');
        $deadline_time = date($this->deadline['year'] . '-' . $this->deadline['month'] . '-' . $this->deadline['day']);
        if ($deadline_time < $current_time)
        {
            return 'Hết hạn nộp hồ sơ';
        } else
        {
            return 'Hạn nộp: ' . $this->deadline['day'] . '/' . $this->deadline['month'] . '/' . $this->deadline['year'];
        }
    }

    public static function findArray($id)
    {
        return Job::find()->select(['title', 'slug', 'category', 'location', 'deadline', 'sell_type', 'price_negotiable', 'price_min', 'price_max'])->where(['_id' => $id])->asArray()->one();
    }

}
