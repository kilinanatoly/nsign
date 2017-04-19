<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ingridients */

$this->title = 'Добавить ингридиент';
$this->params['breadcrumbs'][] = ['label' => 'Ингридиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingridients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
