<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Player */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $model->nation_id = 1;
    $model->team_id = 2;
    $model->age = mt_rand(19,25);
    $model->height = mt_rand(190,210);
    $model->weight = mt_rand(70,90);
    $model->physical_form = mt_rand(0,100);
    $model->strength = mt_rand(0,100);
    $model->aggression = mt_rand(0,100);
    $model->speed = mt_rand(0,100);
    $model->creativity = mt_rand(0,100);
    $model->pass = mt_rand(0,100);
    $model->dribbling = mt_rand(0,100);
    $model->strike = mt_rand(0,100);
    $model->reaction = mt_rand(0,100);
    $model->tackling = mt_rand(0,100);
    $model->custody = mt_rand(0,100);
}

?>

<div class="player-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nation_id')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'physical_form')->textInput() ?>

    <?= $form->field($model, 'strength')->textInput() ?>

    <?= $form->field($model, 'aggression')->textInput() ?>

    <?= $form->field($model, 'speed')->textInput() ?>

    <?= $form->field($model, 'creativity')->textInput() ?>

    <?= $form->field($model, 'pass')->textInput() ?>

    <?= $form->field($model, 'dribbling')->textInput() ?>

    <?= $form->field($model, 'strike')->textInput() ?>

    <?= $form->field($model, 'reaction')->textInput() ?>

    <?= $form->field($model, 'tackling')->textInput() ?>

    <?= $form->field($model, 'custody')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
