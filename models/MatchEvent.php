<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "match_events".
 *
 * @property integer $id
 * @property integer $match_id
 * @property integer $team
 * @property integer $player_id
 * @property integer $event_type
 * @property integer $possession
 * @property integer $points1
 * @property integer $points2
 * @property integer $player2_id
 * @property integer $time Время события
 */
class MatchEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'match_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'team', 'player_id', 'event_type'], 'required'],
            [['match_id', 'team', 'player_id', 'event_type', 'possession', 'points1', 'points2', 'player2_id', 'time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'match_id' => Yii::t('app', 'Match ID'),
            'team' => Yii::t('app', '1 или 2'),
            'player_id' => Yii::t('app', 'Player ID'),
            'event_type' => Yii::t('app', 'Тип события (пас, гол и т.п.)'),
            'possession' => Yii::t('app', 'Владение мячом в процентах (1 команда)'),
            'points1' => Yii::t('app', 'Очки первой команды'),
            'points2' => Yii::t('app', 'Очки второй команды'),
            'player2_id' => Yii::t('app', 'ID второго игрока, участвующего в событии'),
            'time' => Yii::t('app', 'Время события'),
        ];
    }

    public function beforeSave($insert)
    {

        $this->time = ($this->match->getEventsCount()/500)*48*100;

        if ($this->event_type === 8) {
            $this->match->result = $this->points1.' : '.$this->points2;
            $this->match->save();
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne('app\models\Player', ['id' => 'player_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer2()
    {
        return $this->hasOne('app\models\Player', ['id' => 'player2_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne('app\models\Match', ['id' => 'match_id']);
    }

    public static function generateFinal($model,$lastEvent)
    {
        $event = new MatchEvent();
        $event->event_type = 8;
        $event->match_id = $model->id;
        $event->team = 0;
        $event->player_id = 0;
        $event->possession = $lastEvent->possession;
        $event->points1 = $lastEvent->points1;
        $event->points2 = $lastEvent->points2;
        $event->player2_id = 0;
        
        if (!($event->save())) {
            var_dump($event->getErrors()); exit();
        }

        $model->result = $event->points1.' : '.$event->points2;
        $model->save();
        return $event;
    }

    public static function generate($model, $lastEvent)
    {

        // 1 - промахивается, 
        // 2 - попадает из 2-очковой, 
        // 3 - попадает из 3-очковой
        // 4 - подбирает мяч
        // 5 - пас
        // 6 - вбрасывание
        // 7 - перехват
        // 8 - конец матча

        $event = new MatchEvent();
        $event->match_id = $model->id;
        if (is_null($lastEvent)) {
            
            $event->team = mt_rand(1,2);
            $event->event_type = 6;

            $tm = 'team'.$event->team;
            $team = $model->$tm;

            $p_i = mt_rand(0,sizeof($team->players)-1);
            $player = $team->players[$p_i];
            $event->player_id = $player->id;
            if ($event->team === 1) {
                $event->possession = 1;
            } else {
                $event->possession = 0;
            }

            $event->points1 = 0;
            $event->points2 = 0;

        } else {

            $event->points1 = $lastEvent->points1;
            $event->points2 = $lastEvent->points2;
            $event->possession = $lastEvent->possession;

            if (in_array($lastEvent->event_type, [7])) { // смена команды
                $player = $lastEvent->player2;
                $event->player_id - $player->id;
                $event->team = ($lastEvent->team === 1) ? 2 : 1;
            }

            if (in_array($lastEvent->event_type, [6,5,7,4])) {
                if (mt_rand(0,10) < 3) {
                    // Перехват
                    $event->event_type = 7;
                    $event->player_id = ($lastEvent->player2_id)?$lastEvent->player2_id:$lastEvent->player_id;;
                    $event->team = $lastEvent->team;

                    $tm = 'team'.($event->team===1?2:1);
                    $team = $model->$tm;

                    
                        $p_i = array_rand($team->players);
                        $player = $team->players[$p_i];
                        if ($player->id === $event->player_id) {
                            if ($p_i>0) {
                                $p_i--;
                            } else {
                                $p_i++;
                            }
                            $player = $team->players[$p_i];
                        }
                    
                    $event->player2_id = $player->id;
                } else { 
                    if (mt_rand(0,10)<6) {
                        // ещё один пас
                        $event->event_type = 5;
                        $event->player_id = ($lastEvent->player2_id)?$lastEvent->player2_id:$lastEvent->player_id;
                        $event->team = $lastEvent->team;

                        $tm = 'team'.$event->team;
                        $team = $model->$tm;

                        
                        $p_i = array_rand($team->players);
                        $player = $team->players[$p_i];
                        if ($player->id === $event->player_id) {
                            if ($p_i>0) {
                                $p_i--;
                            } else {
                                $p_i++;
                            }
                            $player = $team->players[$p_i];
                        }
                        $event->player2_id = $player->id;
                    } else {
                        // Удар
                        if (mt_rand(0,10)<5) {
                            // промах
                            $event->event_type = 1;
                            $event->player_id = ($lastEvent->player2_id)?$lastEvent->player2_id:$lastEvent->player_id;
                            $event->team = $lastEvent->team;

                            $event->player2_id = 0;
                        } else {
                            if (mt_rand(0,10)<4) {
                                $event->event_type = 3;
                                $event->player_id = ($lastEvent->player2_id)?$lastEvent->player2_id:$lastEvent->player_id;
                                $event->team = $lastEvent->team;
                            } else {
                                $event->event_type = 2;
                                $event->player_id = ($lastEvent->player2_id)?$lastEvent->player2_id:$lastEvent->player_id;
                                $event->team = $lastEvent->team;
                            }

                            $pm = 'points'.$event->team;
                            $event->$pm += $event->event_type;
                        }
                    }
                }
            }

            if (in_array($lastEvent->event_type, [1,2,3])) {
                // после удара подбор
                
                $event->team = $lastEvent->team===1?2:1;
                $event->event_type = 4;
                $tm = 'team'.$event->team;
                $team = $model->$tm;

                $p_i = mt_rand(0,sizeof($team->players)-1);
                $player = $team->players[$p_i];
                $event->player_id = $player->id;
            }

        }
        if ($event->team === 1) {
            $event->possession++;
        }

        if (!($event->save())) {
            var_dump($event->getErrors()); exit();
        }
        return $event;
        
    }
}
