<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngridientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингридиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingridients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить ингридиент', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'reg_date',
            [
                'attribute'=>'active',
                'format'=>'raw',
                'filter'=>['0'=>'Не активно','1'=>'Активно'],
                'value'=>function($data){
                    return $data->active ? 'Активно' : 'Не активно';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
