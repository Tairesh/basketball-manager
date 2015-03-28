<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MatchEvent;

/**
 * MatchEventSearch represents the model behind the search form about `app\models\MatchEvent`.
 */
class MatchEventSearch extends MatchEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'match_id', 'team', 'player_id', 'event_type', 'possession', 'points1', 'points2', 'player2_id'], 'integer'],
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
        $query = MatchEvent::find();

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
            'match_id' => $this->match_id,
            'team' => $this->team,
            'player_id' => $this->player_id,
            'event_type' => $this->event_type,
            'possession' => $this->possession,
            'points1' => $this->points1,
            'points2' => $this->points2,
            'player2_id' => $this->player2_id,
        ]);

        return $dataProvider;
    }
}
