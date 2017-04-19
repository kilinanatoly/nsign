<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingridients".
 *
 * @property integer $id
 * @property string $name
 * @property string $reg_date
 * @property integer $active
 */
class Ingridients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingridients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'active'], 'required'],
            [['name'], 'string'],
            [['reg_date'], 'safe'],
            [['active'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'reg_date' => 'Дата создания',
            'active' => 'Активность',
        ];
    }
}
