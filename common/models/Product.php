<?php

namespace common\models;

use yii\web\UploadedFile;
use yii\mongodb\ActiveRecord;
use Yii;

class Product extends ActiveRecord {

    /**
     * @inheritdoc
     */
    const PUBLIC_NOACTIVE = 1;
    const PUBLIC_ACTIVE = 2;

    public static function collectionName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        $rules = [
            [['title', 'category_id'], 'required', 'message' => '{attribute} không được rỗng'],
            [['price', 'sale', 'fake', 'number', 'status'], 'integer'],
            [['description', 'content', 'price', 'sale', 'fake', 'category_id'], 'string'],
            [['category', 'widget', 'tag', 'images', 'size', 'color'], 'default']
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function attributes() {
        return [
            '_id',
            'category_id',
            'author',
            'title',
            'slug',
            'description',
            'content',
            'price',
            'sale',
            'fake',
            'number',
            'status',
            'category',
            'color',
            'size',
            'widget',
            'tag',
            'images',
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
            'image' => 'Hình ảnh',
            'title' => 'Tiêu dề',
            'description' => 'Mô tả',
            'fake' => 'Giá sỉ',
            'price' => 'Giá',
            'sale' => 'Giá khuyến mãi',
            'content' => 'Nội dung',
            'number' => 'Số lượng',
            'category_id' => 'Danh mục'
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
            'slugBehavior' => [
                'class' => \yii\behaviors\SluggableBehavior::className(),
                'attribute' => 'title'
            ],
        ]);
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->slug = \Yii::$app->convert->string($this->title);
            $this->author = \Yii::$app->user->id;
            $this->status = (int) $this->status;
            $this->price = (int) $this->price;
            $this->fake = (int) $this->fake;
            $this->sale = (int) $this->sale;
        
            $tags = [];
            if (!empty($this->tag)) {
                foreach ($this->tag as $value) {
                    $tag = Tag::find()->where(['title' => $value])->one();
                    if (!$tag) {
                        $tag = new Tag;
                        $tag->title = $value;
                        $tag->save();
                    }
                    $tags[] = $tag->id;
                }
            }
            $this->tag = $tags;

            $files = UploadedFile::getInstances($this, 'images');
            $images = [];
            if (!empty($files)) {
                foreach ($files as $key => $file) {
                    $name = $this->slug . '-' . time();
                    $file->saveAs(\Yii::getAlias("@frontend/web/uploads/") . $name . '.' . $file->extension);
                    $images[] = $name . '.' . $file->extension;
                }
            }

            $this->images = array_merge(!empty($_POST['images']) ? $_POST['images'] : [], $images);

            return true;
        }
        return false;
    }

    public function cats(&$data = [], $parent = null) {
        $category = Category::find()->where(['parent_id' => $parent])->all();
        if (!empty($category)) {
            foreach ($category as $key => $value) {
                if (!empty($this->category) && in_array($value->id, $this->category))
                    $checked = 1;
                else
                    $checked = 0;
                $data[] = ['id' => $value->id, 'title' => $this->getIndent($value->indent) . $value->title, 'checked' => $checked];
                unset($category[$key]);
                $this->cats($data, $value->id);
            }
            return $data;
        }
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

    public function sizes() {
        $model = Size::find()->all();
        foreach ($model as $key => $value) {
            if (!empty($this->size) && in_array($value->id, $this->size))
                $checked = 1;
            else
                $checked = 0;
            $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
        }
        return $data;
    }

    public function colors() {
        $model = Color::find()->all();
        foreach ($model as $key => $value) {
            if (!empty($this->color) && in_array($value->id, $this->color))
                $checked = 1;
            else
                $checked = 0;
            $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
        }
        return $data;
    }

    public function cat_default(&$data = [], $parent = null) {
        $category = Category::find()->where(['parent_id' => $parent])->all();
        foreach ($category as $key => $value) {
            $data[$value->id] = $this->getIndent($value->indent) . $value->title;
            unset($category[$key]);
            $this->cat_default($data, $value->id);
        }
        return $data;
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

    public function getPublish() {
        return [
            self::PUBLIC_ACTIVE => \Yii::t('app', 'Public'),
            self::PUBLIC_NOACTIVE => \Yii::t('app', 'Private'),
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function getCat() {
        return $this->hasOne(Category::className(), ['_id' => 'category_id']);
    }

    public function getCountReview() {
        return Review::find()->where(['product_id' => $this->id])->count();
    }

    public function getIPReview() {
        return Review::find()->where(['ip' => $_SERVER['REMOTE_ADDR'], 'product_id' => $this->id])->one();
    }

    public function getRating() {
        $count = Review::find()->where(['product_id' => $this->id])->count();
        return ($this->countstar * 5) > 0 ? $this->countstar * 10 : 0;
    }

    public function getCountstar() {
        $count_5 = Review::find()->where(['product_id' => $this->id, 'star' => 5])->count();
        $count_4 = Review::find()->where(['product_id' => $this->id, 'star' => 4])->count();
        $count_3 = Review::find()->where(['product_id' => $this->id, 'star' => 3])->count();
        $count_2 = Review::find()->where(['product_id' => $this->id, 'star' => 2])->count();
        $count_1 = Review::find()->where(['product_id' => $this->id, 'star' => 1])->count();
        if (($count_1 + $count_2 + $count_4 + $count_3 + $count_5) > 0) {
            $total = ($count_1 + $count_2 + $count_4 + $count_3 + $count_5) / (($count_5 * 5) + ($count_4 * 4) + ($count_3 * 3) + ($count_2 * 2) + ($count_1 * 1));
            return round($total, 1);
        } else {
            return 0;
        }
    }

    public function excerpt($str, $length) {
        $str = strip_tags($str, '');
        if (strlen($str) < $length)
            return $str;
        else {
            $str = strip_tags($str);
            $str = substr($str, 0, $length);
            $end = strrpos($str, ' ');
            $str = substr($str, 0, $end);
            return $str . '...';
        }
    }

    public function getId() {
        return (string) $this->_id;
    }

    public function getPicture() {
        return !empty($this->images) ? \Yii::$app->params['domain'] . '/uploads/' . $this->images[0] : \Yii::$app->params['domain'] . '/images/default.jpg';
    }

    public function getUrl() {
        return Yii::$app->urlManager->createAbsoluteUrl(['/' . $this->slug]);
    }

    public function getCart() {
        return Yii::$app->urlManager->createAbsoluteUrl(['/cart/' . $model->id]);
    }

}
