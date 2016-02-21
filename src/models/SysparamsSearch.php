<?php

namespace mithun\usermanage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use mithun\parametricfilter\models\SystemParams;

/**
 * SysparamsSearch represents the model behind the search form about `mithun\parametricfilter\models\SystemParams`.
 */
class SysparamsSearch extends SystemParams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['param', 'table', 'key', 'label', 'value', 'ip', 'createdOn', 'updatedOn'], 'safe'],
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
        $query = SystemParams::find()->where('status!=0');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'status' => $this->status,
            'createdOn' => $this->createdOn,
            'updatedOn' => $this->updatedOn,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'param', $this->param])
            ->andFilterWhere(['like', 'table', $this->table])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
