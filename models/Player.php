<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "players".
 *
 * @property integer $id
 * @property string $name
 * @property integer $nation_id
 * @property integer $team_id
 * @property integer $age
 * @property integer $height
 * @property integer $weight
 * @property integer $physical_form
 * @property integer $strength
 * @property integer $aggression
 * @property integer $speed
 * @property integer $creativity
 * @property integer $pass
 * @property integer $dribbling
 * @property integer $strike
 * @property integer $reaction
 * @property integer $tackling
 * @property integer $custody
 *
 * @property Teams $team
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'nation_id', 'team_id', 'age', 'height', 'weight'], 'required'],
            [['nation_id', 'team_id', 'age', 'height', 'weight', 'physical_form', 'strength', 'aggression', 'speed', 'creativity', 'pass', 'dribbling', 'strike', 'reaction', 'tackling', 'custody'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'nation_id' => 'Nation ID',
            'team_id' => 'Team ID',
            'age' => 'Возраст',
            'height' => 'Рост',
            'weight' => 'Вес',
            'physical_form' => 'Физическая форма',
            'strength' => 'Сила',
            'aggression' => 'Агрессия',
            'speed' => 'Скорость',
            'creativity' => 'Креативность',
            'pass' => 'Передача',
            'dribbling' => 'Дриблинг',
            'strike' => 'Удар',
            'reaction' => 'Реакция',
            'tackling' => 'Отбор мяча',
            'custody' => 'Опёка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne('app\models\Team', ['id' => 'team_id']);
    }
}
