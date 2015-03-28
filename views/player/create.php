<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Player */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Player',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Players'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
