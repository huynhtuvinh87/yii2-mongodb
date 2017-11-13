<?php

namespace common\models;

use yii\mongodb\ActiveRecord;

/**
 * Category model
 *
 * @property string $name
 * @property string $sectors
 */
class Setting extends ActiveRecord {

    public static function collectionName() {
        return 'setting';
    }

    public function rules() {
        return [
            [['key', 'value', 'description'], 'string']
        ];
    }

    public function attributes() {
        return [
            '_id', 'key', 'value', 'description',
            'created_at',
            'updated_at'
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
        ]);
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
    
    }

    public function getId() {
        return (string) $this->_id;
    }

}
