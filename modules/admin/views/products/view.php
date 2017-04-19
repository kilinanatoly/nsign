<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'reg_date',
            [
                'attribute'=>'active',
                'value'=>$model->active ? 'Активно' : 'Не активно'
            ],
        ],
    ]) ?>
    <hr>
    <h3>Текущие ингридиенты:</h3>
    <?php if ($currentIngridients) : ?>
        <?php foreach ($currentIngridients as $key=>$value) : ?>
            <p><?=$value->ingridient->name?></p>
        <?php endforeach;?>
    <?php else:?>
            <p>Ингридиентов не найдно</p>
    <?php endif;?>


</div>
