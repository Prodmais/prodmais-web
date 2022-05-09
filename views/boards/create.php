<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Boards */

$this->title = 'Create Boards';
$this->params['breadcrumbs'][] = ['label' => 'Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
