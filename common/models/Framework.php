<?php

namespace common\models;

use yii\mongodb\ActiveRecord;

/**
 * Category model
 *
 * @property string $title
 * @property string $slug
 */
class Framework extends ActiveRecord {

    public static function collectionName() {
        return 'framework';
    }

    public function attributes() {
        return [
            '_id',
            'title',
            'slug',
            'order',
            'created_at',
            'updated_at'
        ];
    }

    public function rules() {
        return [
            [['title'], 'required'],
            [['slug'], 'string']
        ];
    }

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'slugBehavior' => [
                'class' => \common\components\SluggableBehavior::className(),
                'attribute' => 'title'
            ],
        ]);
    }

    public static function findArray($id) {
        return self::find()->select(['title', 'slug'])->where(['_id'=>$id])->asArray()->one();
    }

    public function getId() {
        return (string) $this->_id;
    }

}
