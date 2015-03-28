<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Match */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <h1>Матч между «<?=$model->team1->name?>» и «<?=$model->team2->name?>» <?=date('d-m-Y H:i',$model->date)?></h1>
    <div class="row">
      <div class="col-md-6">
        <h3><?=$model->team1->name?></h3>
        <table class="table">
            <tbody>
                <tr>
                    <th>Владение мячом</th>
                    <td id="possession1"><?=round(100*$lastEvent->possession/$model->getEventsCount())?>%</td>
                </tr>
                <tr>
                    <th>Очки</th>
                    <td id="points1"><?=$lastEvent->points1?></td>
                </tr>
            </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h3><?=$model->team2->name?></h3>
        <table class="table">
            <tbody>
                <tr>
                    <th>Владение мячом</th>
                    <td id="possession2"><?=round(100*(1-$lastEvent->possession/$model->getEventsCount()))?>%</td>
                </tr>
                <tr>
                    <th>Очки</th>
                    <td id="points2"><?=$lastEvent->points2?></td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>

    <ul id="list_events">
    <? foreach ($model->events as $i => $event) { ?>
        
            <? if ($event->event_type === 8) { ?>
                <li> <?=round($event->time/100,2)?>: Матч закончен</li>
            <? } elseif ($event->event_type === 6) { ?>
                <?=round($event->time/100,2)?>: <? echo Html::a($event->player->name,['/player/view','id'=>$event->player_id]).' выигрывает сбрасывание.';?>
            <? } else {
                if (in_array($event->event_type,[2,3])) {?><li <?=$event->team === 1 ? 'style="text-align:right;"' : ''?>> <?=round($event->time/100,2)?>: <? 
                    echo Html::a($event->player->name,['/player/view','id'=>$event->player_id]).' забивает мяч из '.$event->event_type.'-очковой зоны';
                    if (isset($model->events[$i+1])) {
                        // var_dump($model->events[$i-1]);
                        if ($model->events[$i+1]->event_type === 5) {
                            echo " после передачи игрока по имени ".Html::a($model->events[$i+1]->player->name,['/player/view','id'=>$event->player_id]);
                        }
                    }
                    } ?></li><?/*?>
                    
            <?=Html::a($event->player->name,['/player/view','id'=>$event->player_id])?>
             <? switch ($event->event_type) {
                case 1:
                    echo "промахивается";
                break;
                case 2:
                    echo "забивает из 2-ух очковой зоны";
                break;
                case 3:
                    echo "забивает из 3-х очковой зоны";
                break;
                case 4:
                    echo "подбирает мяч";
                break;
                case 5:
                    echo "отдаёт пас игроку по имени ".Html::a($event->player2->name,['/player/view','id'=>$event->player2_id]);
                break;
                case 6:
                    echo "выигрывает вбрасывание";
                break;
                case 7:
                    echo "теряет мяч. ".Html::a($event->player2->name,['/player/view','id'=>$event->player2_id]).' перехватывает мяч';
                break;
            } */} ?>
        
    <? } ?>
    </ul>


</div>
