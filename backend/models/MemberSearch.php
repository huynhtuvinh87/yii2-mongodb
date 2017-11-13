<?php

namespace backend\models;

use common\models\Account;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AdminSearch represents the model behind the search form about `common\modules\Post\models\Post`.
 */
class MemberSearch extends Account
{

    public $keywords;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keywords'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Account::find();
        $query->where(['role' => Account::ROLE_MEMBER])->orderBy('updated_at DESC');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // find by trainer code
        if (!empty($this->keywords))
        {

            $lowerKeywords = strtolower($this->keywords);
            $query->andFilterWhere([
                'or',
                ['like', 'LOWER([[account]].[[username]])', $lowerKeywords]
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'         => $this->id,
            'username'   => $this->username,
            'name'       => $this->name,
            'email'      => $this->email,
            'address'    => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'email', $this->email]);

        $query->orderBy('id DESC');

        return $dataProvider;
    }

}
