<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingridients_for_products".
 *
 * @property integer $id
 * @property integer $ingridient_id
 * @property integer $product_id
 */
class IngridientsForProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingridients_for_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingridient_id', 'product_id'], 'required'],
            [['ingridient_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ingridient_id' => 'Ingridient ID',
            'product_id' => 'Product ID',
        ];
    }
    public function getIngridient(){
        return $this->hasOne(Ingridients::className(),['id'=>'ingridient_id']);
    }
    public function getProduct(){
        return $this->hasOne(Products::className(),['id'=>'product_id']);
    }
}
