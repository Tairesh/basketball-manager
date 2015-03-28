<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MatchEvent */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Match Event',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
