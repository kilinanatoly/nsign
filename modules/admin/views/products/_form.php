<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>
    <hr>
    <h3>Выберите ингридиенты</h3>
    <?php foreach ($allIngridients as $key=>$value) : ?>
        <div class="products-form-item">

            <label>
                <input type="checkbox" <?=(in_array($value->id,$currentIngridients) ? 'checked' : '')?> name="ingridients[]" value="<?= $value->id ?>"><?=$value->name?>
            </label>
        </div>
    <?php endforeach;?>
    <hr>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
