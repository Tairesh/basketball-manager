<?php

namespace app\models;

use Yii;
use app\models\MatchEvent;

/**
 * This is the model class for table "matches".
 *
 * @property integer $id
 * @property integer $team1_id
 * @property integer $team2_id
 * @property integer $date
 * @property string $result
 */
class Match extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team1_id', 'team2_id', 'date'], 'required'],
            [['team1_id', 'team2_id', 'date'], 'integer'],
            [['result'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'team1_id' => Yii::t('app', 'Team1 ID'),
            'team2_id' => Yii::t('app', 'Team2 ID'),
            'date' => Yii::t('app', 'Date'),
            'result' => Yii::t('app', 'Result'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam1()
    {
        return $this->hasOne('app\models\Team', ['id' => 'team1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam2()
    {
        return $this->hasOne('app\models\Team', ['id' => 'team2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(MatchEvent::className(), ['match_id' => 'id'])->orderBy('id DESC');
    }

    public function getEventsCount()
    {
        return count($this->events);
    }
    public function getLastEvent()
    {
        return count($this->events) ? $this->events[0] : null;
    }

}
