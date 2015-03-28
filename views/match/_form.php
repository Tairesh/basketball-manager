<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper		;
use yii\widgets\ActiveForm;
use app\models\Team;

/* @var $this yii\web\View */
/* @var $model app\models\Match */
/* @var $form yii\widgets\ActiveForm */

$teams = Team::find()->all();
$model->date = time();

?>

<div class="match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'team1_id')->dropDownList(ArrayHelper::map($teams,'id','name')) ?>

    <?= $form->field($model, 'team2_id')->dropDownList(ArrayHelper::map($teams,'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
