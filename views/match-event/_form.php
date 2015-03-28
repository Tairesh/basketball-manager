<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatchEvent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'match_id')->textInput() ?>

    <?= $form->field($model, 'team')->textInput() ?>

    <?= $form->field($model, 'player_id')->textInput() ?>

    <?= $form->field($model, 'event_type')->textInput() ?>

    <?= $form->field($model, 'possession')->textInput() ?>

    <?= $form->field($model, 'points1')->textInput() ?>

    <?= $form->field($model, 'points2')->textInput() ?>

    <?= $form->field($model, 'player2_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
