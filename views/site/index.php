<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */

$this->title = 'Главная страница';
?>
<div class="site-index">
    <div class="site-index__ingridients">
        <?php $form = ActiveForm::begin(); ?>
        <div class="site-index__ingridients_list">
            <h3>Выберите ингридиенты для изготовления блюда</h3>
            <?php foreach ($allIngridients as $key=>$value): ?>
                <div class="site-index__ingridients_list_item">
                    <label>
                        <input <?=(in_array($value->id,$currentIngridients) ? 'checked' : '')?> type="checkbox" name="ingridient[]" value="<?=$value->id?>"><?=$value->name?>
                    </label>
                </div>
            <?php endforeach;?>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Поиск</button>
        </div>
        <?php ActiveForm::end(); ?>
        <hr>
        <?php echo Yii::$app->getSession()->getFlash('message');?>
        <?php if ($findProducts) : ?>
            <div class="find-products-list">
                <?php foreach ($findProducts as $key=>$value) : ?>
                    <div class="find-products-list__item">
                        <div class="find-products-list__item_name">
                            <?=$value['product']->name?>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        <?php elseif (count(Yii::$app->request->post('ingridient'))>=2):?>
        <p>Ничего не найдено</p>
        <?php endif;?>

    </div>
</div>
