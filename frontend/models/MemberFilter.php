<?php

namespace frontend\models;

use common\models\Resume;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;
use common\models\ProgrammingLanguage;
use common\models\Framework;
use common\models\Location;

/**
 * This is the model class for table "content_meta".
 *
 * @property integer $category
 * @property array $program
 * @property integer $content_id
 * @property string $meta_key
 * @property string $meta_value
 *
 * @property Content $content
 */
class MemberFilter extends Model {

    public $keywords;
    public $category;
    public $program;
    public $framework;
    public $sell;
    public $location;
    public $_category;
    public $_program;
    public $_framework;
    public $_location;
    public $_sell;
    public $params;

    public function init() {
        parent::init();
        $this->attributes = $this->params;
        $this->_category = Category::find()->all();
        $this->_program = ProgrammingLanguage::find()->all();
        $this->_framework = Framework::find()->all();
        $this->_location = Location::find()->all();
        $this->_sell = ['full_time' => 'Full time', 'part_time' => 'Part time', 'freelance' => 'Freelance', 'contract' => 'Contract'];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category', 'program', 'framework', 'sell', 'location','keywords'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function fillter($params) {
        $query = Resume::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 20
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        if ($this->keywords) {
            $keyword = strtolower($this->keywords);
            $query->where(['like', 'title', $keyword]);
        }
        if ($this->category) {

            $query->where(['category.slug' => $this->category]);
        }
        if ($this->program) {
            $query->where(['programming.slug' => $this->program]);
        }
        if ($this->framework) {
            $query->where(['framework.slug' => $this->framework]);
        }
        if ($this->location) {
            $query->where(['location.slug' => $this->location]);
        }
        if ($this->sell) {
            $query->where(['sell_type' => $this->sell]);
        }
        $query->orderBy(['created_at' => SORT_DESC]);
        return $dataProvider;
    }

}
