<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlayerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'nation_id') ?>

    <?= $form->field($model, 'team_id') ?>

    <?= $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'physical_form') ?>

    <?php // echo $form->field($model, 'strength') ?>

    <?php // echo $form->field($model, 'aggression') ?>

    <?php // echo $form->field($model, 'speed') ?>

    <?php // echo $form->field($model, 'creativity') ?>

    <?php // echo $form->field($model, 'pass') ?>

    <?php // echo $form->field($model, 'dribbling') ?>

    <?php // echo $form->field($model, 'strike') ?>

    <?php // echo $form->field($model, 'reaction') ?>

    <?php // echo $form->field($model, 'tackling') ?>

    <?php // echo $form->field($model, 'custody') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
