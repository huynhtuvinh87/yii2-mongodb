<?php

namespace common\models;

use yii\mongodb\ActiveRecord;
use Yii;
use common\models\Job;

/**
 * Category model
 *
 * @property string $name
 * @property string $sectors
 */
class Category extends ActiveRecord {

    public static function collectionName() {
        return 'category';
    }

    public function rules() {
        return [
            [['title'], 'required', 'message' => '{attribute} không được rỗng'],
            [['slug', 'description', 'parent_id', 'icon'], 'string'],
            [['order'], 'integer'],
        ];
    }

    public function attributes() {
        return [
            '_id',
            'parent_id',
            'title',
            'slug',
            'icon',
            'description',
            'order',
            'indent',
            'type',
            'created_at',
            'updated_at'
        ];
    }

    public function attributeLabels() {
        return [
            'title' => 'Tên danh mục',
            'description' => 'Mô tả',
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

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->slug = \Yii::$app->convert->string($this->title);
            if (!$this->parent_id) {
                $this->parent_id = NULL;
            }
            $parent = Category::findOne($this->parent_id);
            if (!empty($parent)) {
                $this->indent = $parent->indent + 1;
            } else {
                $this->indent = 0;
            }

            return true;
        }
        return false;
    }

    public function getId() {
        return (string) $this->_id;
    }

    public function getIndent($int) {
        if ($int > 0) {
            for ($index = 1; $index <= $int; $index++) {
                $data[] = '—';
            }
            return implode('', $data) . ' ';
        } else
            return '';
    }

    public function getParent() {
        return self::findOne($this->parent_id);
    }

    public function count() {
        return Job::find()->where(['category.slug' => $this->slug])->count();
    }

    public function getUrl() {
        return Yii::$app->urlManager->createAbsoluteUrl(['/category/' . $this->slug]);
    }

    public static function findArray($id) {
        return self::find()->select(['title', 'slug'])->where(['_id' => $id])->asArray()->one();
    }

}
