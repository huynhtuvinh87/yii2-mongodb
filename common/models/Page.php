<?php

namespace common\models;

use yii\web\UploadedFile;
use yii\mongodb\ActiveRecord;

class Page extends ActiveRecord {

    /**
     * @inheritdoc
     */
    const PUBLIC_NOACTIVE = 1;
    const PUBLIC_ACTIVE = 2;

    public static function collectionName() {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        $rules = [
            [['title'], 'required'],
            [['description', 'content', 'slug'], 'string'],
            [['image'], 'file'],
            [['status'], 'integer'],
            [['widget'], 'default']
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function attributes() {
        return [
            '_id',
            'author',
            'title',
            'slug',
            'description',
            'content',
            'status',
            'widget',
            'image',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(
                parent::attributeLabels(), [
            'image' => \Yii::t('app', 'Picture')
                ]
        );
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

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $image = UploadedFile::getInstance($this, 'image');
            if (!empty($image)) {
                $name = $this->slug . '-' . time() . '.' . $image->extension;
                $image->saveAs(\Yii::getAlias("@frontend/web/uploads/") . $name);
                $this->image = $name;
            }
            $this->status = (int) $this->status;
            $this->author = \Yii::$app->user->id;
            $this->slug = \Yii::$app->convert->string($this->title);
            return true;
        }
        return false;
    }

    public function getId() {
        return (string) $this->_id;
    }

    public function widgets() {
        $widget = Widget::find()->all();
        foreach ($widget as $key => $value) {
            if (!empty($this->widget) && in_array($value->id, $this->widget))
                $checked = 1;
            else
                $checked = 0;
            $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
        }
        return $data;
    }

    public function getPublish() {
        return [
            self::PUBLIC_ACTIVE => \Yii::t('app', 'Public'),
            self::PUBLIC_NOACTIVE => \Yii::t('app', 'Private'),
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function getPicture() {
        return !empty($this->image) ? \Yii::$app->params['domain'] . '/uploads/' . $this->image : \Yii::$app->params['domain'] . '/images/default.jpg';
    }

}
