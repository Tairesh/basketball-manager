<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatchEventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'match_id') ?>

    <?= $form->field($model, 'team') ?>

    <?= $form->field($model, 'player_id') ?>

    <?= $form->field($model, 'event_type') ?>

    <?php // echo $form->field($model, 'possession') ?>

    <?php // echo $form->field($model, 'points1') ?>

    <?php // echo $form->field($model, 'points2') ?>

    <?php // echo $form->field($model, 'player2_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
