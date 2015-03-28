<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Player;

/**
 * PlayerSearch represents the model behind the search form about `app\models\Player`.
 */
class PlayerSearch extends Player
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nation_id', 'team_id', 'age', 'height', 'weight', 'physical_form', 'strength', 'aggression', 'speed', 'creativity', 'pass', 'dribbling', 'strike', 'reaction', 'tackling', 'custody'], 'integer'],
            [['name'], 'safe'],
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
        $query = Player::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'nation_id' => $this->nation_id,
            'team_id' => $this->team_id,
            'age' => $this->age,
            'height' => $this->height,
            'weight' => $this->weight,
            'physical_form' => $this->physical_form,
            'strength' => $this->strength,
            'aggression' => $this->aggression,
            'speed' => $this->speed,
            'creativity' => $this->creativity,
            'pass' => $this->pass,
            'dribbling' => $this->dribbling,
            'strike' => $this->strike,
            'reaction' => $this->reaction,
            'tackling' => $this->tackling,
            'custody' => $this->custody,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
