<?php

namespace common\models;

use yii\mongodb\ActiveRecord;

/**
 * Location model
 *
 * @property string $name
 * @property string $sectors
 */
class Log extends ActiveRecord {

    public static function collectionName() {
        return 'log';
    }

    public function rules() {
        return [
            [['key', 'value'], 'string'],
        ];
    }

    public function attributes() {
        return [
            '_id',
            'key',
            'value'
        ];
    }

}
